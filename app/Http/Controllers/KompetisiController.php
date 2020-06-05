<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\Kompetisi;
use App\Panitia;
use App\Peserta;
use App\Rules;
use App\Skor;
use App\Target;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class KompetisiController extends Controller
{
    public function index()
    {
        $title = 'Archery Scoring';
        $title_page = 'Kompetisi';

        $rules_group = Rules::join('kategori', 'rules.uuid_kategori', '=', 'kategori.uuid')
            ->join('kelas', 'rules.uuid_kelas', '=', 'kelas.uuid')
            ->groupBy('kategori.nama_kategori')
            ->groupBy('kelas.nama_kelas')
            ->havingRaw('COUNT(uuid_kategori) > 1')
            ->select('nama_kategori', 'nama_kelas')
            ->get();

        return view('kompetisi/kompetisi')->with(compact('title', 'uuide', 'pnt', 'ntap', 'title_page', 'rules_group'));
    }
    public function detailKategori($kat, $kel)
    {
        $title = 'Archery Scoring';
        $title_page = ' Detail Kompetisi ' . $kat . ' ' . $kel;
        $rules = Rules::join('kategori', 'rules.uuid_kategori', '=', 'kategori.uuid')
            ->join('ronde', 'rules.uuid_ronde', '=', 'ronde.uuid')
            ->join('kelas', 'rules.uuid_kelas', '=', 'kelas.uuid')
            ->where('nama_kategori', $kat)
            ->where('nama_kelas', $kel)
            ->select('kategori.nama_kategori', 'ronde.jk', 'kelas.nama_kelas', 'rules.*')
            ->addSelect(['jml_pesertanya' => Peserta::select(DB::raw('COUNT(uuid)'))
                ->whereColumn('kategori', 'kategori.nama_kategori')
                ->whereColumn('kelas', 'kelas.nama_kelas')
                ->whereColumn('jk', 'ronde.jk')])->orderBy('kategori.nama_kategori', 'asc')->get();
        return view('kompetisi/detailkategori')->with(compact('title', 'title_page', 'rules'));
    }
    public function skorDetail($nama_babak, $uuid_rules)
    {
        $title = 'Skor Detail ' . $nama_babak;
        $title_page = 'Archery Scoring';
        $skor = Skor::join('peserta', 'skor.uuid_peserta', '=', 'peserta.uuid')->where('uuid_rules', $uuid_rules)->orderBy('total', 'DESC')->get();
        return view('kompetisi/detail')->with(compact('title', 'title_page', 'skor'));
    }
    public function addPeserta($kelas, $jk, $uuid_kat, $uuid_rules, $sesi)
    {

        $peserta = Peserta::where('kategori', $uuid_kat)->where('kelas', $kelas)->where('jk', $jk)->select('peserta.uuid')->get();

        $katList = array('A', 'B', 'C', 'D');
        $panitia = Panitia::get(['id']);

        for ($i = 0; $i < $peserta->count(); $i++) {
            $ntap[] = $peserta[$i]['uuid'];
        }
        $uuid_peserta = $ntap;


        for ($i = 0; $i < count($uuid_peserta); $i++) {
            $inp[] = ['uuid' => Str::uuid(), 'uuid_peserta' => $uuid_peserta[$i], 'uuid_rules' => $uuid_rules, 'sesi' => $sesi, 'created_at' => DB::raw('now()')];
        }
        $data = $inp;
        $skor_check = Skor::whereIn('uuid_peserta', $uuid_peserta)->where('uuid_rules', $uuid_rules)->get();
        if ($peserta->count() / (count($katList)) > count($panitia)) {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('alert-slogan', 'Gagal!');
            return redirect()->back()->with(
                Session::flash('message', 'Jumlah wasit/panitia/papan kurang, silahkan crosscheck terlebih dahulu')
            );
        } else if ($peserta->count() / (count($katList)) != count($panitia)) {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('alert-slogan', 'Gagal!');
            return redirect()->back()->with(
                Session::flash('message', 'Jumlah wasit/panitia/papan kurang, silahkan crosscheck terlebih dahulu')
            );
        } else {
            if (!$skor_check) {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('alert-slogan', 'Gagal!');
                return redirect()->back()->with(
                    Session::flash('message', 'Data peserta sudah ada! Tidak bisa di generate ulang, mohon hapus dahulu')
                );
            } else {
                Skor::insert($data);
            }


            for ($i = 0; $i < $panitia->count(); $i++) {
                $ntapz[] = $panitia[$i]['id'];
            }
            $pnt = $ntapz;

            for ($i = 0; $i < $peserta->count() / (count($katList)); $i++) {
                for ($j = 0; $j < count($katList); $j++) {
                    $ntape[] = $pnt[$i];
                }
            }
            $getSkorUuid = Skor::where('sesi', $sesi)->get(['uuid']);
            for ($l = 0; $l < count($ntape); $l++) {
                Skor::where('uuid', $getSkorUuid[$l]['uuid'])->where('sesi', $sesi)->update(['uuid_panitia' => $ntape[$l]]);
            }

            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return redirect()->back()->with(
                Session::flash('message', 'Nomor target berhasil dibuat')
            );
        }
    }
    public function addPesertaManual($kelas, $jk, $uuid_kat, $uuid_rules)
    {
        $title = "Archery Scoring";
        $title_page = "Generate Peserta Manual";
        $panitia = Panitia::get();
        $peserta = Peserta::where('kategori', $uuid_kat)->where('kelas', $kelas)->where('jk', $jk)->select('peserta.uuid', 'peserta.nama_peserta', 'no_target')->orderBy('no_target')->get();
        return view('kompetisi/add')->with(compact('title', 'title_page', 'peserta', 'panitia', 'uuid_rules'));
    }

    // public function generateNoPeserta()
    // {
    //     // 1. Generate panitia peserta dari setiap kategori
    //     // 2. Algoritma -> jika no target

    //     // No target
    //     // jika loop == jumlah peserta dari setiap kategori

    //     try {
    //         $katList = array('A', 'B', 'C', 'D');
    //         $panitia = Panitia::get(['id']);
    //         $peserta = Peserta::where('kategori', 'Nasional')->get()->count();
    //         $kat = explode(",", $katList);

    //         for ($i = 0; $i < $panitia->count(); $i++) {
    //             $ntapz[] = $panitia[$i]['id'];
    //         }
    //         $pnt = $ntapz;

    //         //$huruf = array('A', 'B', 'C', 'D');
    //         for ($i = 0; $i < $peserta / (count($kat)); $i++) {

    //             for ($j = 0; $j < count($kat); $j++) {

    //                 $ntap[] = ['uuid_panitia' => $pnt[$i], 'created_at' => DB::raw('now()')];
    //             }
    //         }

    //         // $targete = Target::join('panitia', 'no_target.uuid_panitia', '=', 'panitia.id')->orderBy('nama_papan', 'ASC')->orderBy('no_target', 'ASC')->get(['nama_papan', 'no_target', 'nama_panitia', 'uuid_panitia']);
    //         // $peserta = Peserta::where('jk', 'P')->where('kelas', 'U-20')->where('kategori', 'Nasional')->orderBy('no_target')->get('no_target');

    //         $peserta = Peserta::orderBy('no_target')->get('no_target');

    //         // for ($i = 0; $i < $peserta->count(); $i++) {
    //         //     Skor::whereNull('skor.uuid_panitia')->join('peserta', 'skor.uuid_peserta', '=', 'peserta.uuid')->where('peserta.no_target', $targete[$i]['nama_papan'] . $targete[$i]['no_target'])->update(
    //         //         ['uuid_panitia' => $targete[$i]['uuid_panitia']]
    //         //     );
    //         // }
    //         // alihkan halaman ke halaman target
    //         Session::flash('alert-class', 'alert-success');
    //         Session::flash('alert-slogan', 'Sukses!');
    //         return redirect('kompetisi')->with(
    //             Session::flash('message', 'Generate no target berhasil!')
    //         );
    //         if (Skor::whereNotNUll('uuid_panitia')) {
    //             Session::flash('alert-class', 'alert-success');
    //             Session::flash('alert-slogan', 'Sukses!');
    //             return redirect('kompetisi')->with(
    //                 Session::flash('message', 'Generate gagal!')
    //             );
    //         }
    //     } catch (\Throwable $th) {
    //         throw $th;
    //     }
    // }
}
