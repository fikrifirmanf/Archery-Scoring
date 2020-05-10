<?php

namespace App\Http\Controllers;

use App\Konten;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class KontenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Konten";
        $konten = Konten::all();
        return view('konten/konten')->with(compact('title', 'konten'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $title = "Tambah Konten";
        return view('konten/add')->with(compact('title'));
    }
    public function prosesAdd(Request $request)
    {
        if (Konten::where('title_notif', '=', $request->title_notif)->exists()) {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('alert-slogan', 'Gagal!');
            return redirect()->back()->with(
                Session::flash('message', 'Judul notif sama, silahkan crosscheck data terlebih dahulu!')
            );
        } else {
            Konten::insert([
                'uuid' => Str::uuid(),
                'title_notif' => $request->title_notif,
                'body_notif' => $request->body_notif,
                'isi_konten' => $request->isi_konten,
                'durasi' => $request->durasi,

            ]);
        }

        // alihkan halaman ke halaman pegawai
        Session::flash('alert-class', 'alert-success');
        Session::flash('alert-slogan', 'Sukses!');
        return redirect('konten/add')->with(
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
        $title = "Konten Detail";
        $konten = Konten::all()->where('uuid', $uuid);
        return view('konten/kontendetail')->with(compact('title', 'konten'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Konten  $konten
     * @return \Illuminate\Http\Response
     */
    public function edit(Konten $konten)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Konten  $konten
     * @return \Illuminate\Http\Response
     */
    public function update($uuid)
    {
        $title = "Edit Konten";
        $konten = Konten::all()->where('uuid', $uuid);
        return view('konten/edit')->with(compact('title', 'konten'));
    }
    public function updateProses(Request $request)
    {
        try {
            Konten::where('uuid', $request->uuid)->update([
                'title_notif' => $request->title_notif,
                'body_notif' => $request->body_notif,
                'isi_konten' => $request->isi_konten,
                'durasi' => $request->durasi,
            ]);
            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return redirect('konten')->with(
                Session::flash('message', 'Konten berhasil di update')
            );
        } catch (\Throwable $th) {
            //throw $th;
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Konten  $konten
     * @return \Illuminate\Http\Response
     */
    public function destroy(Konten $konten)
    {
        //
    }
}
