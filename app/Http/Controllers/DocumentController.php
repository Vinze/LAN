<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller {

    public function getView(Request $request) {
        return view('documents.view');
    }

    public function getForm(Request $request, Document $document) {
        $title = $document->exists ? 'Document bewerken' : 'Document toevoegen';

        return view('documents.form', compact('title', 'document'));
    }

    public function postForm(Request $request, Document $document) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $document->fill($request->all());
        $document->save();

        return redirect('/')->withSuccess('Het document is succesvol opgeslagen.');
    }

}
