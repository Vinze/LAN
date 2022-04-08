<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class DashboardController extends Controller {

    public function getIndex(Request $request) {
        $title = 'LAN feestje';

        $documents = Document::get();

        return view('dashboard.index', compact('title',  'documents'));
    }

}
