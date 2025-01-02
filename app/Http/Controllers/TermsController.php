<?php

namespace App\Http\Controllers;
use App\Models\Term;

use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function show()
    {
        $terms = Term::latest()->first(); // Récupère les CGV les plus récentes
        return view('terms.show', compact('terms'));
    }
}
