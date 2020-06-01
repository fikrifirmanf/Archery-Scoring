<?php

namespace App\Http\Controllers;

use App\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function index()
    {
        $title = 'Archery Scoring';
        $title_page = 'Artikel';
        $artikel = Artikel::get();
        return view('artikel/artikel')->with(compact('title', 'title_page', 'artikel'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $title = 'Archery Scoring';
        $title_page = "Tambah Artikel";
        return view('artikel/add')->with(compact('title', 'title_page'));
    }
    public function prosesAdd(Request $request)
    {
        if (Artikel::where('judul', '=', $request->judul)->exists()) {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('alert-slogan', 'Gagal!');
            return redirect()->back()->with(
                Session::flash('message', 'Judul notif sama, silahkan crosscheck data terlebih dahulu!')
            );
        } else {
            Artikel::insert([
                'uuid' => Str::uuid(),
                'judul' => $request->judul,
                'isi' => $request->isi,
                'tanggal' => date('Y-m-d'),
                'created_at' => DB::raw('now()')

            ]);
        }

        // alihkan halaman ke halaman pegawai
        Session::flash('alert-class', 'alert-success');
        Session::flash('alert-slogan', 'Sukses!');
        return redirect('artikel/add')->with(
            Session::flash('message', 'Konten berhasil dibuat')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Konten  $konten
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $title = 'Archery Scoring';
        $title_page = "Artikel Detail";
        $artikel = Artikel::where('uuid', $uuid)->get();
        return view('artikel/detail')->with(compact('title', 'title_page', 'artikel'));
    }


    public function update($uuid)
    {
        $title = 'Archery Scoring';
        $title_page = "Edit Artikel";
        $artikel = Artikel::where('uuid', $uuid)->get();
        return view('artikel/edit')->with(compact('title', 'title_page', 'artikel'));
    }
    public function updateProses(Request $request)
    {
        try {
            Artikel::where('uuid', $request->uuid)->update([
                'uuid' => Str::uuid(),
                'judul' => $request->judul,
                'isi' => $request->isi,
                'tanggal' => date('Y-m-d'),
                'updated_at' => DB::raw('now()')

            ]);
            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return redirect('artikel')->with(
                Session::flash('message', 'Artikel berhasil di update')
            );
        } catch (\Throwable $th) {
            //throw $th;
            throw $th;
        }
    }

    public function del($uuid)
    {
        $artikel = Artikel::where('uuid', $uuid);
        $artikel->delete();
        Session::flash('alert-class', 'alert-success');
        Session::flash('alert-slogan', 'Sukses!');
        return redirect('artikel')->with(
            Session::flash('message', 'Data artikel berhasil dihapus')
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Konten  $konten
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artikel $rtikel)
    {
        //
    }
}
