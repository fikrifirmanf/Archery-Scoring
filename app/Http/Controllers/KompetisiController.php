<?php

namespace App\Http\Controllers;

use App\Kompetisi;
use App\Peserta;
use App\Rules;
use App\Skor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class KompetisiController extends Controller
{
    public function index()
    {
        $title = 'Archery Scoring';
        $title_page = 'Kompetisi';

        $kompetisi = Kompetisi::join('peserta', 'kompetisi.uuid_peserta', '=', 'kompetisi.uuid')->join('ronde', 'kompetisi.uuid_ronde', '=', 'ronde.uuid')->get();

        $rules = Rules::join('kategori', 'rules.uuid_kategori', '=', 'kategori.uuid')->join('ronde', 'rules.uuid_ronde', '=', 'ronde.uuid')->join('kelas', 'rules.uuid_kelas', '=', 'kelas.uuid')->select('kategori.nama_kategori', 'ronde.jk', 'kelas.nama_kelas', 'rules.*')
            ->addSelect(['jml_peserta' => Peserta::select(DB::raw('COUNT(uuid)'))
                ->whereColumn('kategori', 'kategori.nama_kategori')
                ->whereColumn('kelas', 'kelas.nama_kelas')
                ->whereColumn('jk', 'ronde.jk')])->orderBy('kategori.nama_kategori', 'asc')->get();

        return view('kompetisi/kompetisi')->with(compact('title', 'title_page', 'rules'));
    }
    public function addPeserta($kelas, $jk, $uuid_kat, $uuid_rules)
    {
        // switch ($jk) {
        //     case 'Perempuan':
        //         $jk = 'P';
        //         break;
        //     case 'Laki-Laki':
        //         $jk = 'L';
        //         break;

        //     default:
        //         null;
        //         break;
        // }
        $peserta = Peserta::where('kategori', $uuid_kat)->where('kelas', $kelas)->where('jk', $jk)->select('peserta.uuid')->get();

        for ($i = 0; $i < $peserta->count(); $i++) {
            $ntap[] = $peserta[$i]['uuid'];
        }
        $uuid_peserta = $ntap;

        // for ($i = 0; $i < $peserta->count(); $i++) {

        //     $ntape[] = $peserta[$i]['uuid_panitia'];
        // }
        // $uuid_panitia = $ntape;

        try {
            for ($i = 0; $i < count($uuid_peserta); $i++) {
                $inp[] = ['uuid' => Str::uuid(), 'uuid_peserta' => $uuid_peserta[$i], 'uuid_rules' => $uuid_rules, 'created_at' => DB::raw('now()')];
            }
            $data = $inp;
            $skor_check = Skor::whereIn('uuid_peserta', $uuid_peserta)->where('uuid_rules', $uuid_rules)->get();
            if (!$skor_check) {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('alert-slogan', 'Gagal!');
                return redirect()->back()->with(
                    Session::flash('message', 'Data peserta sudah ada! Tidak bisa di generate ulang, mohon hapus dahulu')
                );
            } else {
                Skor::insert($data);
            }
            // alihkan halaman ke halaman target
            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return redirect('kompetisi')->with(
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
    public function skorDetail($nama_babak, $uuid_rules)
    {
        $title = 'Skor Detail ' . $nama_babak;
        $title_page = 'Archery Scoring';
        $skor = Skor::join('peserta', 'skor.uuid_peserta', '=', 'peserta.uuid')->where('uuid_rules', $uuid_rules)->orderBy('total', 'DESC')->get();
        return view('kompetisi/detail')->with(compact('title', 'title_page', 'skor'));
    }
}
