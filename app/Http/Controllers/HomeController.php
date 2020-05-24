<?php

namespace App\Http\Controllers;

use App\Konten;
use App\Peserta;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = "Archery Scoring";
        $title_page = "Dashboard";
        //$konten = Konten::where('uuid', '392b7900-f28c-4cdd-96e9-f767759de9ee');
        $peserta_nasional = Peserta::where('kategori', 'Nasional')->get()->count();
        $peserta_recurve = Peserta::where('kategori', 'Recurve')->get()->count();
        $peserta_compound = Peserta::where('kategori', 'Compound')->get()->count();
        $jml_peserta = Peserta::get()->count();


        return view('home')->with(compact('title', 'title_page', 'jml_peserta', 'peserta_nasional', 'peserta_recurve', 'peserta_compound'));
    }
}
