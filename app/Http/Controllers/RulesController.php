<?php

namespace App\Http\Controllers;

use App\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class RulesController extends Controller
{
    public function index(Request $request)
    {
        $title = "Rules";
        $title_page = "Pengaturan";
        $rules = Rules::join('jarak', 'rules.uuid_jarak', '=', 'jarak.uuid_jarak')->join('kelas', 'rules.uuid_kelas', '=', 'kelas.uuid')->join('kategori', 'rules.uuid_kategori', '=', 'kategori.uuid')->join('ronde', 'rules.uuid_ronde', '=', 'ronde.uuid')->select('rules.*', 'jarak.nama_jarak', 'ronde.nama_ronde', 'kelas.nama_kelas', 'kategori.nama_kategori')->get();


        return $this->makeResponse($request, 'rules/rules', compact('title', 'rules', 'title_page'));
    }
    public function create()
    {
        $title = 'Archery Scoring';
        $title_page = 'Tambah Rules';
        return view('rules/add')->with(compact('title', 'title_page'));
    }
    public function prosesAdd(Request $request)
    {

        try {
            Rules::insert([
                'uuid' => Str::uuid(),
                'jml_seri' => $request->jml_seri,
                'jml_panah' => $request->jml_panah,
                'uuid_ronde' => $request->uuid_ronde,
                'uuid_jarak' => $request->uuid_jarak,
                'uuid_kelas' => $request->uuid_kelas,
                'uuid_kategori' => $request->uuid_kategori,
                'jml_peserta' => $request->jml_peserta,
                'created_at' => DB::raw('now()')
            ]);
            // alihkan halaman ke halaman ronde
            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return redirect('rules/add')->with(
                Session::flash('message', 'Rules berhasil dibuat')
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // public function update($uuid)
    // {

    //     $title = 'Archery Scoring';
    //     $title_page = 'Edit Ronde';
    //     $ronde = Ronde::where('uuid', $uuid)->get();
    //     return view('ronde/edit')->with(compact('title', 'ronde', 'title_page'));
    // }

    // public function prosesEdit(Request $request)
    // {
    //     $ronde = Ronde::where('nama_ronde', $request->nama_ronde);
    //     if ($ronde->exists()) {
    //         Session::flash('alert-class', 'alert-danger');
    //         Session::flash('alert-slogan', 'Gagal!');
    //         return redirect()->back()->with(
    //             Session::flash('message', 'Data ronde sudah ada!')
    //         );
    //     } else {
    //         Ronde::where('uuid', $request->uuid)->update([
    //             'uuid' => Str::uuid(),
    //             'nama_ronde' => $request->nama_ronde,
    //             'updated_at' => DB::raw('now()')
    //         ]);
    //         // alihkan halaman ke halaman ronde
    //         Session::flash('alert-class', 'alert-success');
    //         Session::flash('alert-slogan', 'Sukses!');
    //         return redirect('ronde')->with(
    //             Session::flash('message', 'Ronde berhasil diubah')
    //         );
    //     }
    // }
}
