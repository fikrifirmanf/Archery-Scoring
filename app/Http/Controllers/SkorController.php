<?php

namespace App\Http\Controllers;

use App\Skor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class SkorController extends Controller
{
    public function index(Request $request)
    {
        $title = "Skor";
        $title_page = "Skor";
        $skor = Skor::join('peserta', 'skor.uuid_peserta', '=', 'peserta.id')->join('ronde', 'skor.uuid_ronde', '=', 'ronde.uuid')->get();


        return $this->makeResponse($request, 'skor/skor', compact('title', 'skor', 'title_page'));
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
            Skor::insert([
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
    public function skorApi()
    {
        $skor = Skor::join('peserta', 'skor.uuid_peserta', '=', 'peserta.uuid')->join('no_target', 'peserta.uuid_target', '=', 'no_target.uuid')->join('ronde', 'skor.uuid_ronde', '=', 'ronde.uuid')->select('skor.uuid', 'no_target.nama_target', 'peserta.nama_peserta', 'skor.seri_1', 'skor.seri_2', 'skor.seri_3', 'skor.seri_4', 'skor.seri_5', 'skor.seri_6', 'skor.total', 'ronde.nama_ronde')->orderBy('sesi')->get();
        return response()->json(['skor' => $skor], 200);
    }

    public function prosesUpdateApi(Request $request, $sesi, $seri, $uuidr, $uuidp)
    {

        $id = Auth::id();
        $skor = Skor::where('uuid_rules', $uuidr)->where('uuid_peserta', $uuidp)->where('sesi', $sesi)->value($seri);


        try {

            if ($skor > 0) {
                return response()->json([
                    "skor" => "Skor sudah ada!"
                ], 428);
            } else {
                Skor::where('uuid_rules', $uuidr)->where('uuid_peserta', $uuidp)->update([
                    $seri => $request->seri,

                ]);;


                return response()->json([
                    "skor" => "Sukses!"
                ], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e], 503);
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
