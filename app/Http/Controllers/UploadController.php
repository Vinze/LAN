<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Upload;

class UploadController extends Controller {

    public function getUpload($uid, $filename) {
        $storage = Storage::disk('nfs');
        $upload = Upload::where('uid', $uid)->where('filename', $filename)->firstOrFail();

        if ( ! $storage->exists($upload->filepath)) {
            abort(404, 'Bestand niet gevonden op de server');
        }

        return $storage->response($upload->filepath, $upload->filename);
    }

    public function postUpload(Request $request) {
        $request->validate([
            'linkage' => 'required',
            'uploads' => 'required'
        ]);

        $linkage = base64_decode($request->input('linkage'));
        list($linkage_type, $linkage_id) = explode(':', $linkage);

        if ($request->hasFile('uploads')) {
            $files = $request->file('uploads');
            foreach ($files as $file) {
                $upload = new Upload([
                    'linkage_type' => $linkage_type,
                    'linkage_id' => $linkage_id,
                ]);
                $upload->storeAndSave($file);
            }
            return back()->with('success', 'De bestand(en) zijn succesvol geüpload.');
        } else {
            return back()->with('error', 'De bestanden konden niet geüpload worden.');
        }
    }

}