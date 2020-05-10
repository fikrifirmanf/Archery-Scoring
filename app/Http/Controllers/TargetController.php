<?php

namespace App\Http\Controllers;

use App\Target;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class TargetController extends Controller
{
    public function index(Request $request)
    {
        $title = "Target";
        $title_page = "Pengaturan";
        $target = Target::get();


        return $this->makeResponse($request, 'target/target', compact('title', 'target', 'title_page'));
    }
    public function create()
    {
        $title = 'Archery Scoring';
        $title_page = 'Tambah target';
        return view('target/add')->with(compact('title', 'title_page'));
    }
    public function prosesAdd(Request $request)
    {
        try {
            $katList = $request->kat_target;
            $kat = explode(",", $katList);

            //$huruf = array('A', 'B', 'C', 'D');
            for ($i = 1; $i <= $request->jml_papan; $i++) {

                for ($j = 0; $j < count($kat); $j++) {

                    $ntap[] = ['uuid' => Str::uuid(), 'nama_target' => $kat[$j] . $i, 'created_at' => DB::raw('now()')];
                }
            }
            $data = $ntap;
            Target::insert($data);
            // alihkan halaman ke halaman target
            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return redirect('target')->with(
                Session::flash('message', 'Nomor target berhasil dibuat')
            );
        } catch (\Throwable $th) {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('alert-slogan', 'Gagal!');
            return redirect()->back()->with(
                Session::flash('message', 'Data target sudah ada! atau' . $th)
            );
        }
    }

    // public function update($uuid)
    // {

    //     $title = 'Archery Scoring';
    //     $title_page = 'Edit Ronde';
    //     $ronde = Ronde::where('uuid', $uuid)->get();
    //     return view('ronde/edit')->with(compact('title', 'ronde', 'title_page', 'ntape'));
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

    public function delAll()
    {
        $targete = Target::get('uuid');

        try {
            Target::whereIn('uuid', $targete)->delete();
            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return redirect('target')->with(
                Session::flash('message', 'Data target berhasil dihapus')
            );
        } catch (\Throwable $th) {
            throw $th;
            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return redirect('target')->with(
                Session::flash('message', 'Data target gagal dihapus!')
            );
        }
    }
}
