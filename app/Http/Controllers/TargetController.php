<?php

namespace App\Http\Controllers;

use App\Panitia;
use App\Target;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Peserta;


class TargetController extends Controller
{
    public function index(Request $request)
    {
        $title = "Target";
        $title_page = "Pengaturan";
        $target = Target::join('panitia', 'no_target.uuid_panitia', '=', 'panitia.id')->select('nama_papan', 'panitia.nama_panitia')->havingRaw('COUNT(no_target.uuid) > 1')->groupBy('nama_papan', 'panitia.nama_panitia')->get();



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
            $panitia = Panitia::get(['id']);
            $peserta = Peserta::get()->count();
            $kat = explode(",", $katList);

            for ($i = 0; $i < $panitia->count(); $i++) {
                $ntapz[] = $panitia[$i]['id'];
            }
            $pnt = $ntapz;

            //$huruf = array('A', 'B', 'C', 'D');
            for ($i = 0; $i < $peserta / (count($kat)); $i++) {

                for ($j = 0; $j < count($kat); $j++) {

                    $ntap[] = ['uuid' => Str::uuid(), 'nama_papan' => $i + 1, 'no_target' => $kat[$j], 'uuid_panitia' => $pnt[$i], 'created_at' => DB::raw('now()')];
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

    public function generateNoPeserta()
    {
        try {

            $target = Target::get(['uuid']);
            $peserta = Peserta::get();


            for ($i = 0; $i < $target->count(); $i++) {
                $ntapz[] = $target[$i]['uuid'];
            }
            $trg = $ntapz;

            //$huruf = array('A', 'B', 'C', 'D');
            for ($i = 0; $i < $peserta->count(); $i++) {


                Peserta::join('kelas', 'peserta.uuid_kelas', '=', 'kelas.uuid')->where('peserta.uuid', $peserta[$i]['uuid'])->orderByRaw('jk desc')->update(
                    [
                        'uuid_target' => $trg[$i]
                    ]
                );
            }

            // alihkan halaman ke halaman target
            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return redirect('target')->with(
                Session::flash('message', 'Generate no target berhasil!')
            );
        } catch (\Throwable $th) {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('alert-slogan', 'Gagal!');
            return redirect()->back()->with(
                Session::flash('message', 'Generate no target gagal!' . $th)
            );
        }
    }

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
