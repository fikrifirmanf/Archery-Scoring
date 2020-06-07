<?php

namespace App\Http\Controllers;

use App\Panitia;
use App\Peserta;
use App\Rules;
use App\Skor;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use PDF;

class KompetisiController extends Controller
{
    public function index()
    {
        $title = 'Archery Scoring';
        $title_page = 'Hasil Skor Kompetisi';

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
    public function skorDetailTotal($nama_babak, $uuid_rules)
    {
        $title = 'Skor Detail Total ' . $nama_babak;
        $title_page = 'Archery Scoring';
        $skor = Skor::join('peserta', 'skor.uuid_peserta', '=', 'peserta.uuid')->where('uuid_rules', $uuid_rules)->orderBy('total', 'DESC')->get();
        return view('kompetisi/detail')->with(compact('title', 'title_page', 'skor'));
    }
    public function addPeserta($kelas, $jk, $uuid_kat, $uuid_rules, $sesi)
    {

        $peserta = Peserta::where('kategori', $uuid_kat)->where('kelas', $kelas)->where('jk', $jk)->select('peserta.uuid')->get();

        if ($peserta->count() <= 0) {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('alert-slogan', 'Gagal!');
            return back()->with(
                Session::flash('message', 'Data peserta tidak ada')
            );
        }

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
        $skor_check = Skor::where('uuid_rules', $uuid_rules)->value('uuid_rules');

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
            if ($skor_check == $uuid_rules) {
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
                Session::flash('message', 'Data Peserta berhasil di daftarkan')
            );
        }
    }
    public function addPesertaManual($kelas, $jk, $uuid_kat, $uuid_rules)
    {
        $title = "Archery Scoring";
        $title_page = "Generate Peserta Manual";
        $jmlPsrt = Rules::where('uuid', $uuid_rules)->value('jml_peserta');
        $jmlPsrtKompetisi = Skor::where('uuid_rules', $uuid_rules)->get(['uuid_peserta']);
        if ($jmlPsrtKompetisi->count() >= $jmlPsrt) {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('alert-slogan', 'Gagal!');
            return redirect()->back()->with(
                Session::flash('message', 'Peserta sudah lengkap')
            );
        }
        $panitia = Panitia::get();
        $peserta = Peserta::whereNotIn('uuid', $jmlPsrtKompetisi)->where('kategori', $uuid_kat)->where('kelas', $kelas)->where('jk', $jk)->select('peserta.uuid', 'peserta.nama_peserta', 'no_target')->orderBy('no_target')->get();
        return view('kompetisi/add')->with(compact('title', 'title_page', 'peserta', 'panitia', 'uuid_rules'));
    }
    public function prosesAdd(Request $request)
    {
        $jmlPsrt = Rules::where('uuid', $request->uuid_rules)->value('jml_peserta');
        $jmlPsrtKompetisi = Skor::where('uuid_rules', $request->uuid_rules)->get();
        if ($jmlPsrtKompetisi->count() == $jmlPsrt) {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('alert-slogan', 'Gagal!');
            return back()->with(
                Session::flash('message', 'Peserta sudah lengkap')
            );
        } else if ($request->uuid_peserta1 == $request->uuid_peserta2) {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('alert-slogan', 'Gagal!');
            return back()->with(
                Session::flash('message', 'Terdapat peserta yang sama, silahkan crosscheck')
            );
        } else {
            Skor::insert([
                'uuid' => Str::uuid(),
                'uuid_peserta' => $request->uuid_peserta1,
                'uuid_rules' => $request->uuid_rules,
                'uuid_panitia' => $request->uuid_panitia,
                'created_at' => DB::raw('now()')
            ]);
            Skor::insert([
                'uuid' => Str::uuid(),
                'uuid_peserta' => $request->uuid_peserta2,
                'uuid_rules' => $request->uuid_rules,
                'uuid_panitia' => $request->uuid_panitia,
                'created_at' => DB::raw('now()')
            ]);
            // alihkan halaman ke halaman ronde
            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return back()->with(
                Session::flash('message', 'Peserta berhasil didaftarkan')
            );
        }
    }


    public function del($uuid_rules)
    {
        $skor = Skor::where('uuid_rules', $uuid_rules);
        if ($skor->count() <= 0) {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('alert-slogan', 'Gagal!');
            return redirect()->back()->with(
                Session::flash('message', 'Data peserta tidak ada')
            );
        }
        $skor->delete();
        Session::flash('alert-class', 'alert-success');
        Session::flash('alert-slogan', 'Sukses!');
        return redirect()->back()->with(
            Session::flash('message', 'Data peserta kompetisi berhasil dihapus')
        );
    }
    public function cetakPdf($nama_babak, $uuid_rules)
    {
        $title = $nama_babak;
        $skor = Skor::join('peserta', 'skor.uuid_peserta', '=', 'peserta.uuid')->where('uuid_rules', $uuid_rules)->orderBy('total', 'DESC')->get();
        $pdf = PDF::loadview('kompetisi/cetak_pdf', compact('title', 'skor'))->setPaper('a4', 'landscape');
        return $pdf->stream('laporan-skor');
    }
}
