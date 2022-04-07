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
        $title = 'Inloggen verplicht';

        return view('auth.login', compact('title'));
    }

    public function getOauth($service) {
        abort_unless(in_array($service, ['telegram']), 404);

        return Socialite::driver($service)->redirect();
    }

    public function getOauthCallback(Request $request, $service) {
        abort_unless(in_array($service, ['telegram']), 404);

        if ($request->has('error')) {
            Log::error('Oauth inloggen mislukt', $request->all());

            return redirect('login')->withError('Er is een fout opgetreden bij het inloggen.');
        }
        $socialUser = Socialite::driver($service)->user();

        dd($socialUser);


        // $user = User::firstOrNew(['users.email' => $socialUser->email]);
        // $user->email = $socialUser->email;
        // $user->{$service} = [
        //     'id' => $socialUser->id,
        //     'token' => $socialUser->token,
        //     'refreshToken' => $socialUser->refreshToken,
        //     'expiresIn' => $socialUser->expiresIn,
        // ];
        // $user->save();

        // Auth::login($user, true);

        // session()->regenerate();

        // return redirect()->intended('/');
    }

    public function getLogout() {
        Auth::user()->gebruiker_id = null;
        Auth::user()->azure = null;
        Auth::user()->save();

        Auth::logout();

        session()->forget(['login_user', 'login_email', 'remember']);

        return redirect('login');
    }

}
