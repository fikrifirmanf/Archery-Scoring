<?php

namespace App\Http\Controllers;

use App\Artikel;

class ArtikelController extends Controller
{
    public function index()
    {
        $title = 'Archery Scoring';
        $title_page = 'Artikel';
        $artikel = Artikel::get();
        return view('artikel/artikel')->with(compact('title', 'title_page', 'artikel'));
    }
}
