<?php
namespace App\Http\Controllers;

use App\Mail\PasswordReset;
use App\Models\Gebruiker;
use App\Models\Relatie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use PragmaRX\Google2FA\Google2FA;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AuthController extends Controller {

    public function getLogin() {
        $email = session('login_email');

        return view('auth.login', compact('email'));
    }

    public function getLoginEmail() {
        $email = session('login_email');

        return view('auth.login-email', compact('email'));
    }

    public function postLoginEmail(Request $request) {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        session(['remember' => $request->has('remember')]);

        $user = User::whereHas('gebruikers')
            ->where('users.email', $request->input('email'))
            ->first();

        if ( ! $user) {
            return back()->withInput()->withError('Er is geen account gekoppeld aan dit e-mail adres, klik hieronder op registreren om een nieuw account aan te maken.');
        }

        if (Hash::check($request->input('password'), $user->password)) {
            if ($user->google2fa) {
                session(['login_user' => $user->user_id]);

                return redirect('login/2fa');
            }

            return $this->login($user, session('remember'));
        }

        return back()->withInput()->withError('De combinatie e-mail adres en wachtwoord is onjuist.');
    }

    public function getLogin2fa() {
        if ( ! $user = User::whereHas('gebruikers')->find(session('login_user'))) {
            return redirect('login');
        }

        return view('auth.login-2fa');
    }

    public function postLogin2fa(Request $request) {
        $request->validate([
            'code' => 'required|integer'
        ]);
        if ( ! $user = User::whereHas('gebruikers')->find(session('login_user'))) {
            return redirect('login');
        }

        $code = preg_replace('/[^0-9]/', '', $request->input('code'));

        $google2fa = new Google2FA();
        if ( ! $google2fa->verifyKey($user->google2fa, $code)) {
            return back()->with('error', 'De verificatiecode is niet correct of reeds verlopen, probeer het opnieuw.');
        }

        return $this->login($user, session('remember'));
    }

    public function getOauth($service) {
        abort_unless(in_array($service, ['azure', 'github']), 404);

        return Socialite::driver($service)->redirect();
    }

    public function getOauthCallback(Request $request, $service) {
        if ($request->has('error')) {
            Log::error('Oauth inloggen mislukt', $request->all());

            return redirect('login')->withError('Er is een fout opgetreden bij het inloggen.');
        }
        $socialUser = Socialite::driver($service)->user();

        if ( ! Gebruiker::active($socialUser->email)->exists()) {
            return redirect('login')->withError('Het e-mail adres '.$socialUser->email.' staat niet in ons systeem, neem contact op met de servicedesk.');
        }

        $user = User::firstOrNew(['users.email' => $socialUser->email]);
        $user->email = $socialUser->email;
        $user->{$service} = [
            'id' => $socialUser->id,
            'token' => $socialUser->token,
            'refreshToken' => $socialUser->refreshToken,
            'expiresIn' => $socialUser->expiresIn,
        ];
        $user->save();

        return $this->login($user, false);
    }

    public function getRegister() {
        return view('auth.register');
    }

    public function postRegister(Request $request) {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $email = $request->input('email');

        $exists = Gebruiker::active($email)->exists();

        if ($exists) {
            $user = User::firstOrNew(['users.email' => $email]);
            $user->email = $email;
            $user->password_reset = Str::random(32);
            $user->save();

            Mail::to($user->email)->send(new PasswordReset($user));

            session(['login_email' => $user->email]);
        }

        return redirect('register')->with('account_exists', $exists);
    }

    public function getLoginAs(Request $request, $id = null) {
        if (Auth::user()->administrator && Auth::user()->freezit_gebruiker) {
            if ($id && $relatie = Relatie::actief()->find($id)) {
                Auth::user()->gebruiker_id = Auth::user()->freezit_gebruiker->id;
                Auth::user()->relatie_id = $relatie->id;
                Auth::user()->save();

                return redirect('/')->with('success', 'Je bent succesvol van relatie gewisseld.');
            } else if ($id) {
                abort(404);
            }

            $relaties = Relatie::search($request)
                ->orderByBeheer()
                ->paginate(54, ['id', 'naam', 'logo', 'mkb_beheer']);

            return view('auth.login-as', compact('relaties'));
        } else {
            $gebruikers = Auth::user()->gebruikers()
                ->with('relatie:id,naam,logo')
                ->get(['id', 'relatie_id', 'naam']);

            if ($id && $gebruiker = $gebruikers->firstWhere('id', $id)) {
                Auth::user()->gebruiker_id = $gebruiker->id;
                Auth::user()->relatie_id = $gebruiker->relatie_id;
                Auth::user()->save();

                return redirect('/')->with('success', 'Je bent succesvol van account gewisseld.');
            } else if ($id) {
                abort(404);
            }

            $gebruikers = $gebruikers->sortBy(function($gebruiker) {
                return $gebruiker->relatie->naam.'-'.$gebruiker->naam;
            });

            return view('auth.login-as', compact('gebruikers'));
        }
    }

    public function getReset($hash) {
        if ( ! $user = User::validateHash($hash)->first()) {
            return redirect('login/email')->withError('De link om een wachtwoord in te stellen is verlopen of reeds gebruikt.');
        }

        return view('auth.reset', compact('user'));
    }

    public function postReset(Request $request, $hash) {
        if ( ! $user = User::validateHash($hash)->first()) {
            return redirect('login/email')->withError('De link om een wachtwoord in te stellen is verlopen.');
        }

        $request->validate([
            'password' => ['required'],
            'password_repeat' => ['same:password'],
        ]);

        $user->password = $request->input('password');
        $user->password_reset = null;
        $user->save();

        session(['login_email' => $user->email]);

        return redirect('login/email')->withInput(['email' => $user->email])->with('success', 'Je kunt nu inloggen met het zojuist opgegeven wachtwoord.');
    }

    public function getAccount() {
        $user = Auth::user();
        $socialUser = null;

        // if ($user->azure) {
        //     $socialUser = Socialite::driver('azure')->userFromToken($user->azure['token']);
        // }

        if ( ! $user->google2fa) {
            $google2fa = new Google2FA();
            $secret = $google2fa->generateSecretKey();
            $url = $google2fa->getQRCodeUrl('Mijn Freez.it', $user->email, $secret);
            $qrcode = QrCode::format('svg')->size(200)->generate($url);

            // $options = new QROptions(['addQuietzone' => false]);
            // $qrcode = (new QRCode($options))->render($url);
        } else {
            $secret = null;
            $url = null;
            $qrcode = null;
        }

        return view('auth.account', compact('user', 'socialUser', 'secret', 'url', 'qrcode'));
    }

    public function postChangePassword(Request $request) {
        $request->validate([
            'password_current' => 'required|current_password',
            'password' => 'required|confirmed',
        ]);

        Auth::user()->password = $request->input('password');
        Auth::user()->save();

        return back()->with('success', 'Je nieuwe wachtwoord is succesvol ingesteld en je kunt hier voortaan mee inloggen.');
    }

    public function postSetup2fa(Request $request) {
        $user = Auth::user();

        if ($user->google2fa) {
            $request->validate([
                'password_current' => 'required|current_password',
            ]);
            $user->google2fa = null;
            $user->save();

            return back()->with('success', 'Tweestapsverificatie is succesvol uitgeschakeld en bij de volgende keer inloggen is geen authenticatiecode meer benodigd.');
        }

        $this->validate($request, [
            'code' => 'required|min:6',
            'secret' => 'required'
        ]);

        $code = preg_replace('/[^0-9]/', '', $request->input('code'));
        $secret = $request->input('secret');

        $google2fa = new Google2FA();

        if ( ! $google2fa->verifyKey($secret, $code)) {
            return back()->with('error', 'Verificatiecode is niet correct, scan de QR code opnieuw en voer deze dan nogmaals in.');
        }

        $user->google2fa = $secret;
        $user->save();

        return back()->with('success', 'Tweestapsverificatie is succesvol ingeschakeld en bij de volgende keer inloggen moet u naast uw gebruikersnaam en wachtwoord ook een verificatiecode opgeven.');
    }

    public function getLogout() {
        Auth::user()->gebruiker_id = null;
        Auth::user()->azure = null;
        Auth::user()->save();

        Auth::logout();

        session()->forget(['login_user', 'login_email', 'remember']);

        return redirect('login');
    }

    private function login($user, $remember = false) {
        if ($user->administrator && $user->freezit_gebruiker) {
            $user->gebruiker_id = $user->freezit_gebruiker->id;
        } else if (count($user->gebruikers) == 1) {
            $user->gebruiker_id = $user->gebruikers[0]->id;
            $user->relatie_id = $user->gebruikers[0]->relatie_id;
        } else {
            $user->gebruiker_id = null;
            $user->relatie_id = null;
        }

        $user->login_at = now();
        if ($user->password_reset) {
            $user->password_reset = null;
        }

        $user->save();

        Auth::login($user, $remember);

        session()->regenerate();
        session()->forget(['login_user', 'login_email', 'remember']);

        return redirect()->intended('/');
    }

}
