<?php

namespace App\Http\Controllers;

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

        return view('kompetisi/kompetisi')->with(compact('title', 'title_page', 'rules_group'));
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
    public function addPeserta($kelas, $jk, $uuid_kat, $uuid_rules)
    {

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
    public function addPesertaManual($kelas, $jk, $uuid_kat, $uuid_rules)
    {
        $title = "Archery Scoring";
        $title_page = "Generate Peserta Manual";
        $panitia = Panitia::get();
        $peserta = Peserta::where('kategori', $uuid_kat)->where('kelas', $kelas)->where('jk', $jk)->select('peserta.uuid', 'peserta.nama_peserta', 'no_target')->orderBy('no_target')->get();
        return view('kompetisi/add')->with(compact('title', 'title_page', 'peserta', 'panitia', 'uuid_rules'));
    }

    public function generateNoPeserta()
    {
        Skor::whereNotNull('uuid_panitia')->update([
            'uuid_panitia' => null,

        ]);

        try {

            $targete = Target::join('panitia', 'no_target.uuid_panitia', '=', 'panitia.id')->orderBy('nama_papan', 'ASC')->orderBy('no_target', 'ASC')->get(['nama_papan', 'no_target', 'nama_panitia', 'uuid_panitia']);
            $peserta = Peserta::orderBy('no_target')->get('no_target');

            for ($i = 0; $i < $peserta->count(); $i++) {
                Skor::join('peserta', 'skor.uuid_peserta', '=', 'peserta.uuid')->where('peserta.no_target', $targete[$i]['nama_papan'] . $targete[$i]['no_target'])->update(
                    ['uuid_panitia' => $targete[$i]['uuid_panitia']]
                );
            }
            // alihkan halaman ke halaman target
            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return redirect('kompetisi')->with(
                Session::flash('message', 'Generate no target berhasil!')
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
