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
        $jml_peserta = Peserta::get()->count();
        $peserta_nasional = Peserta::join('kategori', 'peserta.uuid_kategori', '=', 'kategori.uuid')->where('kategori.nama_kategori', 'Nasional')->get()->count();
        $jml_peserta = Peserta::get()->count();
        $jml_peserta = Peserta::get()->count();


        return view('home')->with(compact('title', 'title_page', 'jml_peserta', 'peserta_nasional'));
    }
}
