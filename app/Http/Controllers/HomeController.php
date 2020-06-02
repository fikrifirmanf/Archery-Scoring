<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Artikel;
use App\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $title = "Archery Scoring";
        $title_page = "Dashboard";
        //$konten = Konten::where('uuid', '392b7900-f28c-4cdd-96e9-f767759de9ee');
        $artikel = Artikel::where('kategori_artikel', 'Petunjuk')->orderBy('created_at')->get();
        $peserta_nasional = Peserta::where('kategori', 'Nasional')->get()->count();
        $peserta_recurve = Peserta::where('kategori', 'Recurve')->get()->count();
        $peserta_compound = Peserta::where('kategori', 'Compound')->get()->count();
        $jml_peserta = Peserta::get()->count();


        return view('home')->with(compact('title', 'title_page', 'artikel', 'jml_peserta', 'peserta_nasional', 'peserta_recurve', 'peserta_compound'));
    }

    public function login()
    {
        return view('login');
    }
    public function loginPost(Request $request)
    {

        $username = $request->username;
        $password = $request->password;

        $data = Admin::where('username', $username)->first();
        if ($data) { //apakah username tersebut ada atau tidak
            if (Hash::check($password, $data->password)) {
                Session::put('name', $data->name);
                Session::put('username', $data->username);
                Session::put('login', TRUE);
                return redirect('home');
            } else {
                return redirect('login')->with('alert', 'Password atau Username, Salah !');
            }
        } else {
            return redirect('login')->with('alert', 'Username, Tidak ada!');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('login')->with('alert', 'Kamu sudah logout');
    }
}
