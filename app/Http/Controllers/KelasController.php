<?php

namespace App\Http\Controllers;

use App\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::get();
        $title_page = "Archery Scoring";
        $title = "Kelas";

        return view('kelas/kelas')->with(compact('title', 'title_page', 'kelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Archery Scoring";
        $title_page = "Tambah Kelas";
        return view('kelas/add')->with(compact('title_page', 'title'));
    }

    public function prosesAdd(Request $request)
    {
        if (Kelas::where('nama_kelas', '=', $request->nama_kelas)->exists()) {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('alert-slogan', 'Gagal!');
            return redirect()->back()->with(
                Session::flash('message', 'Kelas sudah ada, silahkan crosscheck data terlebih dahulu!')
            );
        }
        // insert data ke table pegawai
        else {

            Kelas::insert([
                'uuid' => (string) Str::uuid(),
                'nama_kelas' => $request->nama_kelas,
                'created_at' => DB::raw('now()')
            ]);

            // alihkan halaman ke halaman pegawai
            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return redirect('kelas/add')->with(
                Session::flash('message', 'Data kelas berhasil diinput')
            );
        }
    }



    public function update($uuid)
    {
        $title = 'Archery Scoring';
        $title_page = "Edit Kelas";
        $kelas = Kelas::where('uuid', $uuid)->get();
        return view('kelas/edit')->with(compact('title', 'title_page', 'kelas'));
    }
    public function updateProses(Request $request)
    {
        try {
            Kelas::where('uuid', $request->uuid)->update([
                'uuid' => Str::uuid(),
                'nama_kelas' => $request->nama_kelas,
                'updated_at' => DB::raw('now()')

            ]);
            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return redirect('kelas')->with(
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
     * @param  \App\Panitia  $panitia
     * @return \Illuminate\Http\Response
     */
    public function del($uuid)
    {
        $kelas = Kelas::where('uuid', $uuid);
        $kelas->delete();
        Session::flash('alert-class', 'alert-success');
        Session::flash('alert-slogan', 'Sukses!');
        return redirect('kelas')->with(
            Session::flash('message', 'Data kelas berhasil dihapus')
        );
    }
}
