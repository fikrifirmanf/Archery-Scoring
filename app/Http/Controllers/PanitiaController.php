<?php

namespace App\Http\Controllers;

use App\Imports\PanitiaImport;
use App\Kategori;
use App\Panitia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class PanitiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $panitia = Panitia::orderBy('created_at', 'ASC')->get();
        $title_page = "Archery Scoring";
        $title = "Panitia";

        return view('panitia/panitia')->with(compact('title', 'title_page', 'panitia'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Archery Scoring";
        $title_page = "Tambah Panitia";
        $kategori = Kategori::get();
        return view('panitia/add')->with(compact('title_page', 'title', 'kategori'));
    }

    public function prosesAdd(Request $request)
    {
        if (Panitia::where('username', '=', $request->username)->exists()) {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('alert-slogan', 'Gagal!');
            return redirect()->back()->with(
                Session::flash('message', 'Username sudah ada, silahkan crosscheck data terlebih dahulu!')
            );
        }
        // insert data ke table pegawai
        else {
            $this->validate($request, [
                'nama_panitia' => 'required|min:3',
                'username' => 'required|min:4',
                'password' => 'required',
                'confirmation' => 'required|same:password',
            ]);
            Panitia::insert([
                'id' => (string) Str::uuid(),
                'nama_panitia' => $request->nama_panitia,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'jk_peserta' => $request->jk_peserta,
                'kategori' => $request->kategori,
                'created_at' => DB::raw('now()')
            ]);

            // alihkan halaman ke halaman pegawai
            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return redirect('panitia/add')->with(
                Session::flash('message', 'Data panitia berhasil diinput')
            );
        }
    }

    public function import_excel(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_peserta di dalam folder public
        $file->move(public_path('/file_panitia'), $nama_file);

        // import data
        Excel::import(new PanitiaImport, public_path('/file_panitia/' . $nama_file));

        // notifikasi dengan session
        Session::flash('sukses', 'Data Panitia Berhasil Diimport!');

        // alihkan halaman kembali
        return redirect('panitia/add');
    }

    public function profile()
    {
        $id = Auth::id();
        $panitia = Panitia::where('id', $id)->get();
        return response()->json(['panitia' => $panitia], 200);
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
     * @param  \App\Panitia  $panitia
     * @return \Illuminate\Http\Response
     */
    public function show(Panitia $panitia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Panitia  $panitia
     * @return \Illuminate\Http\Response
     */
    public function edit(Panitia $panitia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Panitia  $panitia
     * @return \Illuminate\Http\Response
     */
    public function update($uuid)
    {

        $title = 'Archery Scoring';
        $title_page = 'Ubah Profil';
        $kategori = Kategori::get();
        $panitia = Panitia::where('id', $uuid)->get();

        return view('panitia/edit')->with(compact('panitia', 'title', 'title_page', 'kategori'));
    }
    public function prosesEdit(Request $request)
    {

        if ($request->password == "") {
            $this->validate($request, [
                'nama_panitia' => 'required|min:3',
                'username' => 'required|min:4',

            ]);
            Panitia::where('id', $request->uuid)->update([

                'nama_panitia' => $request->nama_panitia,
                'username' => $request->username,
                'jk_peserta' => $request->jk_peserta,
                'kategori' => $request->kategori,
                'updated_at' => DB::raw('now()')
            ]);


            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return redirect()->back()->with(
                Session::flash('message', 'Panitia berhasil diubah')
            );
        } else {
            $this->validate($request, [
                'nama_panitia' => 'required|min:3',
                'username' => 'required|min:4',
                'confirmation' => 'same:password',
            ]);
            Panitia::where('id', $request->uuid)->update([

                'nama_panitia' => $request->nama_panitia,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'jk_peserta' => $request->jk_peserta,
                'kategori' => $request->kategori,
                'updated_at' => DB::raw('now()')
            ]);

            // alihkan halaman ke halaman pegawai


            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return redirect()->back()->with(
                Session::flash('message', 'Panitia berhasil diubah')
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Panitia  $panitia
     * @return \Illuminate\Http\Response
     */
    public function del($id)
    {
        $panitia = Panitia::find($id);
        Panitia::find($id)->update([

            'username' => Str::uuid(),
            'password' => Str::uuid()

        ]);
        $panitia->delete();
        Session::flash('alert-class', 'alert-success');
        Session::flash('alert-slogan', 'Sukses!');
        return redirect('panitia')->with(
            Session::flash('message', 'Data panitia berhasil dihapus')
        );
    }
}
