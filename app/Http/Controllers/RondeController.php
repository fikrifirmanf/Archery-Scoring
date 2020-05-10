<?php

namespace App\Http\Controllers;

use App\Ronde;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class RondeController extends Controller
{
    public function index(Request $request)
    {
        $title = "Ronde";
        $title_page = "Pengaturan";
        $ronde = Ronde::get();


        return $this->makeResponse($request, 'ronde/ronde', compact('title', 'ronde', 'title_page'));
    }
    public function create()
    {
        $title = 'Archery Scoring';
        $title_page = 'Tambah Ronde';
        return view('ronde/add')->with(compact('title', 'title_page'));
    }
    public function prosesAdd(Request $request)
    {

        $ronde = Ronde::where('nama_ronde', $request->nama_ronde);
        if ($ronde->exists()) {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('alert-slogan', 'Gagal!');
            return redirect()->back()->with(
                Session::flash('message', 'Data ronde sudah ada!')
            );
        } else {
            Ronde::insert([
                'uuid' => Str::uuid(),
                'nama_ronde' => $request->nama_ronde,
                'created_at' => DB::raw('now()')
            ]);
            // alihkan halaman ke halaman ronde
            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return redirect('ronde/add')->with(
                Session::flash('message', 'Ronde berhasil dibuat')
            );
        }
    }

    public function update($uuid)
    {

        $title = 'Archery Scoring';
        $title_page = 'Edit Ronde';
        $ronde = Ronde::where('uuid', $uuid)->get();
        return view('ronde/edit')->with(compact('title', 'ronde', 'title_page'));
    }

    public function prosesEdit(Request $request)
    {
        $ronde = Ronde::where('nama_ronde', $request->nama_ronde);
        if ($ronde->exists()) {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('alert-slogan', 'Gagal!');
            return redirect()->back()->with(
                Session::flash('message', 'Data ronde sudah ada!')
            );
        } else {
            Ronde::where('uuid', $request->uuid)->update([
                'uuid' => Str::uuid(),
                'nama_ronde' => $request->nama_ronde,
                'updated_at' => DB::raw('now()')
            ]);
            // alihkan halaman ke halaman ronde
            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return redirect('ronde')->with(
                Session::flash('message', 'Ronde berhasil diubah')
            );
        }
    }
}
