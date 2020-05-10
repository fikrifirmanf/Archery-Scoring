<?php

namespace App\Http\Controllers;

use App\Konten;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = "Archery Scoring";
        $title_page = "Dashboard";
        //$konten = Konten::where('uuid', '392b7900-f28c-4cdd-96e9-f767759de9ee');



        return view('home')->with(compact('title', 'title_page'));
    }
}
