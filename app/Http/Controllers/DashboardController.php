<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class DashboardController extends Controller {

    public function getIndex(Request $request) {
        $documents = Document::get();

        return view('dashboard.index', compact('documents'));
    }

}
