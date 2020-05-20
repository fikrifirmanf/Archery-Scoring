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

        $rules = Rules::join('ronde', 'rules.uuid_ronde', '=', 'ronde.uuid')->join('kelas', 'rules.uuid_kelas', '=', 'kelas.uuid')->select('ronde.jk', 'kelas.nama_kelas', 'rules.*')->get();

        return view('kompetisi/kompetisi')->with(compact('title', 'title_page', 'rules'));
    }
    public function addPeserta($kelas, $jk, $uuid_rules)
    {
        $peserta = Peserta::join('kelas', 'peserta.uuid_kelas', '=', 'kelas.uuid')->where('jk', $jk)->where('kelas.nama_kelas', $kelas)->join('no_target', 'peserta.uuid_target', '=', 'no_target.uuid')->select('peserta.uuid', 'no_target.uuid_panitia')->get();

        for ($i = 0; $i < $peserta->count(); $i++) {
            $ntap[] = $peserta[$i]['uuid'];
        }
        $uuid_peserta = $ntap;

        for ($i = 0; $i < $peserta->count(); $i++) {

            $ntape[] = $peserta[$i]['uuid_panitia'];
        }
        $uuid_panitia = $ntape;

        try {
            for ($i = 0; $i < count($uuid_peserta); $i++) {
                $inp[] = ['uuid' => Str::uuid(), 'uuid_panitia' => $uuid_panitia[$i], 'uuid_peserta' => $uuid_peserta[$i], 'uuid_rules' => $uuid_rules, 'created_at' => DB::raw('now()')];
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
    public function skorDetail($nama_babak, $uuid_ronde)
    {
        $title = 'Skor Detail ' . $nama_babak;
        $title_page = 'Archery Scoring';
        $skor = Skor::join('peserta', 'skor.uuid_peserta', '=', 'peserta.uuid')->where('uuid_ronde', $uuid_ronde)->orderBy('total', 'DESC')->get();
        return view('kompetisi/detail')->with(compact('title', 'title_page', 'skor'));
    }
}
