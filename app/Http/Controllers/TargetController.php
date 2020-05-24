<?php

namespace App\Http\Controllers;

use App\Panitia;
use App\Target;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Peserta;
use App\Skor;

class TargetController extends Controller
{
    public function index(Request $request)
    {
        $title = "Target";
        $title_page = "Pengaturan";
        $target = Target::join('panitia', 'no_target.uuid_panitia', '=', 'panitia.id')->select('nama_papan', 'panitia.nama_panitia')->havingRaw('COUNT(no_target.uuid) > 1')->groupBy('nama_papan', 'panitia.nama_panitia')->get();

        $targete = Target::join('panitia', 'no_target.uuid_panitia', '=', 'panitia.id')->orderBy('nama_papan', 'ASC')->orderBy('no_target', 'ASC')->get(['nama_papan', 'no_target', 'nama_panitia']);
        $peserta = Peserta::get();





        return $this->makeResponse($request, 'target/target', compact('title', 'trg', 'target', 'title_page'));
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
