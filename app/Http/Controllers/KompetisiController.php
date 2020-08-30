<?php

namespace App\Http\Controllers;

use App\Panitia;
use App\Peserta;
use App\Rules;
use App\Skor;
use App\Target;
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
        $cek_sesinas = Rules::where('sesi', 4)->get();
        $rules = Rules::join('kategori', 'rules.uuid_kategori', '=', 'kategori.uuid')
            ->join('ronde', 'rules.uuid_ronde', '=', 'ronde.uuid')
            ->join('kelas', 'rules.uuid_kelas', '=', 'kelas.uuid')
            ->where('nama_kategori', $kat)
            ->where('nama_kelas', $kel)
            ->select('kategori.nama_kategori', 'ronde.jk', 'kelas.nama_kelas', 'rules.*')
            ->addSelect(['jml_pesertanya' => Peserta::select(DB::raw('COUNT(uuid)'))
                ->whereColumn('kategori', 'kategori.nama_kategori')
                ->whereColumn('kelas', 'kelas.nama_kelas')
                ->whereColumn('jk', 'ronde.jk')])->orderBy('rules.created_at', 'asc')->get();
        return view('kompetisi/detailkategori')->with(compact('title', 'title_page', 'rules', 'cek_sesinas'));
    }
    public function skorDetail($nama_babak, $uuid_rules)
    {
        $title = 'Skor ' . $nama_babak;
        $title_page = 'Archery Scoring';
        $skor = Skor::join('peserta', 'skor.uuid_peserta', '=', 'peserta.uuid')->where('uuid_rules', $uuid_rules)->orderBy('total', 'DESC')->get();
        return view('kompetisi/detail')->with(compact('title', 'title_page', 'skor'));
    }
    public function skorDetailTotal($nama_babak, $kelas, $jk, $uuid_kat)
    {
        $title = 'Skor Total ' . $nama_babak;
        $title_page = 'Archery Scoring';


        $uuidRules = Rules::where('uuid_kategori', $uuid_kat)
            ->where('kelas.nama_kelas', $kelas)
            ->where('ronde.jk', $jk)
            ->where('nama', 'LIKE', '%kualifikasi%')
            ->join('ronde', 'rules.uuid_ronde', '=', 'ronde.uuid')
            ->join('kelas', 'rules.uuid_kelas', '=', 'kelas.uuid')
            ->get(['rules.uuid']);
        if (!isset($uuidRules)) {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('alert-slogan', 'Gagal!');
            return back()->with(
                Session::flash('message', 'Silahkan daftar data peserta kualifikasi terlebih dahulu')
            );
        }

        $cek_sesinas = Rules::where('uuid_kategori', $uuid_kat)
            ->where('kelas.nama_kelas', $kelas)
            ->where('ronde.jk', $jk)->where('sesi', 3)
            ->join('ronde', 'rules.uuid_ronde', '=', 'ronde.uuid')
            ->join('kelas', 'rules.uuid_kelas', '=', 'kelas.uuid')->get();


        if ($cek_sesinas->isNotEmpty()) {

            $skor = Skor::whereIn('uuid_rules', $uuidRules)
                ->where('skor.sesi', 1)
                ->join('peserta', 'skor.uuid_peserta', '=', 'peserta.uuid')
                ->join('rules', 'skor.uuid_rules', '=', 'rules.uuid')
                ->join('ronde', 'rules.uuid_ronde', '=', 'ronde.uuid')
                ->join('kategori', 'rules.uuid_kategori', '=', 'kategori.uuid')
                ->select('no_target', 'team', 'nama_peserta', 'nama_kategori', 'total')
                ->orderBy('nama_peserta')
                ->get();
            $skor2 = Skor::whereIn('uuid_rules', $uuidRules)
                ->where('skor.sesi', 2)
                ->join('peserta', 'skor.uuid_peserta', '=', 'peserta.uuid')
                ->join('rules', 'skor.uuid_rules', '=', 'rules.uuid')
                ->join('ronde', 'rules.uuid_ronde', '=', 'ronde.uuid')
                ->join('kategori', 'rules.uuid_kategori', '=', 'kategori.uuid')
                ->select('no_target', 'team', 'nama_peserta', 'nama_kategori', 'total')
                ->orderBy('nama_peserta')
                ->get();
            $skor3 = Skor::whereIn('uuid_rules', $uuidRules)
                ->where('skor.sesi', 3)
                ->join('peserta', 'skor.uuid_peserta', '=', 'peserta.uuid')
                ->join('rules', 'skor.uuid_rules', '=', 'rules.uuid')
                ->join('ronde', 'rules.uuid_ronde', '=', 'ronde.uuid')
                ->join('kategori', 'rules.uuid_kategori', '=', 'kategori.uuid')
                ->select('no_target', 'team', 'nama_peserta', 'nama_kategori', 'total')
                ->orderBy('nama_peserta')
                ->get();

            for ($i = 0; $i < ($skor->count() + $skor2->count() + $skor3->count()) / 3; $i++) {
                $item['no_target'] = $skor[$i]['no_target'];
                $item['nama_peserta'] = $skor[$i]['nama_peserta'];
                $item['team'] = $skor[$i]['team'];
                $item['nama_kategori'] = $skor[$i]['nama_kategori'];
                $item['sesi1'] = $skor[$i]['total'];
                $item['sesi2'] = $skor2[$i]['total'];
                $item['sesi3'] = $skor3[$i]['total'];
                $item['total_all'] =  $skor[$i]['total'] + $skor2[$i]['total'] + $skor3[$i]['total'];

                $totalall[] = $item;
            }
        } else {
            $skor = Skor::whereIn('uuid_rules', $uuidRules)
                ->where('skor.sesi', 1)
                ->join('peserta', 'skor.uuid_peserta', '=', 'peserta.uuid')
                ->join('rules', 'skor.uuid_rules', '=', 'rules.uuid')
                ->join('ronde', 'rules.uuid_ronde', '=', 'ronde.uuid')
                ->join('kategori', 'rules.uuid_kategori', '=', 'kategori.uuid')
                ->select('no_target', 'team', 'nama_peserta', 'nama_kategori', 'total')
                ->orderBy('nama_peserta')
                ->get();
            $skor2 = Skor::whereIn('uuid_rules', $uuidRules)
                ->where('skor.sesi', 2)
                ->join('peserta', 'skor.uuid_peserta', '=', 'peserta.uuid')
                ->join('rules', 'skor.uuid_rules', '=', 'rules.uuid')
                ->join('ronde', 'rules.uuid_ronde', '=', 'ronde.uuid')
                ->join('kategori', 'rules.uuid_kategori', '=', 'kategori.uuid')
                ->select('no_target', 'team', 'nama_peserta', 'nama_kategori', 'total')
                ->orderBy('nama_peserta')
                ->get();
            for ($i = 0; $i < ($skor->count() + $skor2->count()) / 2; $i++) {
                $item['no_target'] = $skor[$i]['no_target'];
                $item['nama_peserta'] = $skor[$i]['nama_peserta'];
                $item['team'] = $skor[$i]['team'];
                $item['nama_kategori'] = $skor[$i]['nama_kategori'];
                $item['sesi1'] = $skor[$i]['total'];
                $item['sesi2'] = $skor2[$i]['total'];
                $item['total_all'] =  $skor[$i]['total'] + $skor2[$i]['total'];

                $totalall[] = $item;
            }
            // if (isset($skor) && isset($skor2)) {
            //     Session::flash('alert-class', 'alert-danger');
            //     Session::flash('alert-slogan', 'Gagal!');
            //     return back()->with(
            //         Session::flash('message', 'Silahkan daftar data peserta kualifikasi terlebih dahulu')
            //     );
            // }


        }
        if (empty($totalall)) {
            Session::flash('alert-class', 'alert-info');
            Session::flash('alert-slogan', 'Info!');
            return back()->with(
                Session::flash('message', 'Skor/peserta belum di input!')
            );
        }
        return view('kompetisi/total')->with(compact('title', 'title_page', 'totalall'));
    }
    public function addPeserta($kelas, $jk, $uuid_kat, $uuid_rules, $sesi)
    {
        date_default_timezone_set("Asia/Jakarta");
        $uuid_peserta = Peserta::where('kategori', $uuid_kat)
            ->where('kelas', $kelas)
            ->where('jk', $jk)
            ->orderBy('no_target', 'ASC')
            ->get(['no_target', 'uuid']);

        if ($uuid_peserta->count() <= 0) {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('alert-slogan', 'Gagal!');
            return back()->with(
                Session::flash('message', 'Data peserta tidak ada')
            );
        }
        $target = Target::value('no_target');
        $katList = explode(',', $target);
        $panitia = Panitia::where('kategori', $uuid_kat)->where('jk_peserta', $jk)->orderBy('created_at', 'ASC')
            ->get(['id']);

        for ($i = 0; $i < count($uuid_peserta); $i++) {
            $inp[] = ['uuid' => Str::uuid(), 'uuid_peserta' => $uuid_peserta[$i]['uuid'], 'uuid_rules' => $uuid_rules, 'sesi' => $sesi, 'created_at' => DB::raw('now()')];
        }
        $data = $inp;
        $skor_check = Skor::where('uuid_rules', $uuid_rules)->value('uuid_rules');

        if ($uuid_peserta->count() / (count($katList)) > count($panitia)) {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('alert-slogan', 'Gagal!');
            return redirect()->back()->with(
                Session::flash('message', 'Jumlah wasit/panitia/papan kurang, silahkan crosscheck terlebih dahulu')
            );
        } else if ($uuid_peserta->count() / (count($katList)) != count($panitia)) {
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

            for ($i = 0; $i < $uuid_peserta->count() / (count($katList)); $i++) {
                for ($j = 0; $j < count($katList); $j++) {
                    $ntape[] = $pnt[$i];
                }
            }
            $getSkorUuid = Skor::where('sesi', $sesi)->where('uuid_rules', $uuid_rules)
                ->join('peserta', 'skor.uuid_peserta', '=', 'peserta.uuid')
                ->orderBy('peserta.no_target', 'ASC')
                ->get(['skor.uuid']);
            for ($l = 0; $l < count($ntape); $l++) {
                Skor::where('uuid', $getSkorUuid[$l]['uuid'])->where('uuid_rules', $uuid_rules)->where('sesi', $sesi)->update(['uuid_panitia' => $ntape[$l]]);
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
        $jmlPanitiaKompetisi = Skor::where('uuid_rules', $uuid_rules)->get(['uuid_panitia']);
        if ($jmlPsrtKompetisi->count() >= $jmlPsrt) {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('alert-slogan', 'Gagal!');
            return redirect()->back()->with(
                Session::flash('message', 'Peserta sudah lengkap')
            );
        }
        $panitia = Panitia::whereNotIn('id', $jmlPanitiaKompetisi)->where('kategori', $uuid_kat)->where('jk_peserta', $jk)->orderBy('created_at', 'ASC')
            ->get();
        $peserta = Peserta::whereNotIn('uuid', $jmlPsrtKompetisi)->where('kategori', $uuid_kat)->where('kelas', $kelas)->where('jk', $jk)->select('peserta.uuid', 'peserta.nama_peserta', 'no_target')->orderBy('no_target')->get();
        return view('kompetisi/add')->with(compact('title', 'title_page', 'peserta', 'panitia', 'uuid_rules'));
    }
    public function prosesAdd(Request $request)
    {
        $jmlPsrt = Rules::where('uuid', $request->uuid_rules)->value('jml_peserta');
        $jmlPsrtKompetisi = Skor::where('uuid_rules', $request->uuid_rules)->get();
        // if ($jmlPsrtKompetisi->count() == $jmlPsrt) {
        //     Session::flash('alert-class', 'alert-danger');
        //     Session::flash('alert-slogan', 'Gagal!');
        //     return back()->with(
        //         Session::flash('message', 'Peserta sudah lengkap')
        //     );
        // } else 
        if ($request->uuid_peserta1 == $request->uuid_peserta2) {
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
        $pdf = PDF::loadview('kompetisi/cetak_pdf', compact('title', 'skor', 'nama_babak'))->setPaper('a4', 'landscape');
        return $pdf->stream('laporan-skor');
    }
    public function cetakTotalPdf($nama_babak, $kelas, $jk, $uuid_kat)
    {
        $title = $nama_babak;
        $uuidRules = Rules::where('uuid_kategori', $uuid_kat)
            ->where('kelas.nama_kelas', $kelas)
            ->where('ronde.jk', $jk)
            ->where('nama', 'LIKE', '%kualifikasi%')
            ->join('ronde', 'rules.uuid_ronde', '=', 'ronde.uuid')
            ->join('kelas', 'rules.uuid_kelas', '=', 'kelas.uuid')
            ->get(['rules.uuid']);
        $cek_sesinas = Rules::where('uuid_kategori', $uuid_kat)
            ->where('kelas.nama_kelas', $kelas)
            ->where('ronde.jk', $jk)->where('sesi', 3)
            ->join('ronde', 'rules.uuid_ronde', '=', 'ronde.uuid')
            ->join('kelas', 'rules.uuid_kelas', '=', 'kelas.uuid')->get();



        if ($cek_sesinas->isNotEmpty()) {

            $skor = Skor::whereIn('uuid_rules', $uuidRules)
                ->where('skor.sesi', 1)
                ->join('peserta', 'skor.uuid_peserta', '=', 'peserta.uuid')
                ->join('rules', 'skor.uuid_rules', '=', 'rules.uuid')
                ->join('ronde', 'rules.uuid_ronde', '=', 'ronde.uuid')
                ->join('kategori', 'rules.uuid_kategori', '=', 'kategori.uuid')
                ->select('no_target', 'team', 'nama_peserta', 'nama_kategori', 'total')
                ->orderBy('nama_peserta')
                ->get();
            $skor2 = Skor::whereIn('uuid_rules', $uuidRules)
                ->where('skor.sesi', 2)
                ->join('peserta', 'skor.uuid_peserta', '=', 'peserta.uuid')
                ->join('rules', 'skor.uuid_rules', '=', 'rules.uuid')
                ->join('ronde', 'rules.uuid_ronde', '=', 'ronde.uuid')
                ->join('kategori', 'rules.uuid_kategori', '=', 'kategori.uuid')
                ->select('no_target', 'team', 'nama_peserta', 'nama_kategori', 'total')
                ->orderBy('nama_peserta')
                ->get();
            $skor3 = Skor::whereIn('uuid_rules', $uuidRules)
                ->where('skor.sesi', 3)
                ->join('peserta', 'skor.uuid_peserta', '=', 'peserta.uuid')
                ->join('rules', 'skor.uuid_rules', '=', 'rules.uuid')
                ->join('ronde', 'rules.uuid_ronde', '=', 'ronde.uuid')
                ->join('kategori', 'rules.uuid_kategori', '=', 'kategori.uuid')
                ->select('no_target', 'team', 'nama_peserta', 'nama_kategori', 'total')
                ->orderBy('nama_peserta')
                ->get();

            for ($i = 0; $i < ($skor->count() + $skor2->count() + $skor3->count()) / 3; $i++) {
                $item['no_target'] = $skor[$i]['no_target'];
                $item['nama_peserta'] = $skor[$i]['nama_peserta'];
                $item['team'] = $skor[$i]['team'];
                $item['nama_kategori'] = $skor[$i]['nama_kategori'];
                $item['sesi1'] = $skor[$i]['total'];
                $item['sesi2'] = $skor2[$i]['total'];
                $item['sesi3'] = $skor3[$i]['total'];
                $item['total_all'] =  $skor[$i]['total'] + $skor2[$i]['total'] + $skor3[$i]['total'];

                $totalall[] = $item;
            }
        } else {
            $skor = Skor::whereIn('uuid_rules', $uuidRules)
                ->where('skor.sesi', 1)
                ->join('peserta', 'skor.uuid_peserta', '=', 'peserta.uuid')
                ->join('rules', 'skor.uuid_rules', '=', 'rules.uuid')
                ->join('ronde', 'rules.uuid_ronde', '=', 'ronde.uuid')
                ->join('kategori', 'rules.uuid_kategori', '=', 'kategori.uuid')
                ->select('no_target', 'team', 'nama_peserta', 'nama_kategori', 'total')
                ->orderBy('nama_peserta')
                ->get();
            $skor2 = Skor::whereIn('uuid_rules', $uuidRules)
                ->where('skor.sesi', 2)
                ->join('peserta', 'skor.uuid_peserta', '=', 'peserta.uuid')
                ->join('rules', 'skor.uuid_rules', '=', 'rules.uuid')
                ->join('ronde', 'rules.uuid_ronde', '=', 'ronde.uuid')
                ->join('kategori', 'rules.uuid_kategori', '=', 'kategori.uuid')
                ->select('no_target', 'team', 'nama_peserta', 'nama_kategori', 'total')
                ->orderBy('nama_peserta')
                ->get();
            for ($i = 0; $i < ($skor->count() + $skor2->count()) / 2; $i++) {
                $item['no_target'] = $skor[$i]['no_target'];
                $item['nama_peserta'] = $skor[$i]['nama_peserta'];
                $item['team'] = $skor[$i]['team'];
                $item['nama_kategori'] = $skor[$i]['nama_kategori'];
                $item['sesi1'] = $skor[$i]['total'];
                $item['sesi2'] = $skor2[$i]['total'];

                $item['total_all'] =  $skor[$i]['total'] + $skor2[$i]['total'];

                $totalall[] = $item;
            }
            // if (isset($skor) && isset($skor2)) {
            //     Session::flash('alert-class', 'alert-danger');
            //     Session::flash('alert-slogan', 'Gagal!');
            //     return back()->with(
            //         Session::flash('message', 'Silahkan daftar data peserta kualifikasi terlebih dahulu')
            //     );
            // }


        }
        if (empty($totalall)) {
            Session::flash('alert-class', 'alert-info');
            Session::flash('alert-slogan', 'Info!');
            return back()->with(
                Session::flash('message', 'Skor/peserta belum di input!')
            );
        }

        $pdf = PDF::loadview('kompetisi/cetak_pdf', compact('title', 'totalall', 'nama_babak'))->setPaper('a4', 'landscape');
        return $pdf->stream('laporan-skor');
    }

    // edit skor

    public function update($uuid)
    {

        $title = 'Archery Scoring';
        $title_page = 'Edit Skor';
        $skor = Skor::where('uuid', $uuid)->join('peserta', 'skor.uuid_peserta', '=', 'peserta.uuid')->select('skor.*', 'peserta.nama_peserta', 'peserta.no_target', 'peserta.team', 'peserta.uuid as pesertaUuid')->get();
        return view('kompetisi/edit')->with(compact('title', 'title_page', 'skor'));
    }

    public function prosesEdit(Request $request)
    {
        try {
            Skor::where('uuid', $request->uuid)->update([
                'seri_1' => $request->seri_1,
                'seri_2' => $request->seri_2,
                'seri_3' => $request->seri_3,
                'seri_4' => $request->seri_4,
                'seri_5' => $request->seri_5,
                'seri_6' => $request->seri_6,
                'total' => $$request->seri_1 + $request->seri_2 + $request->seri_3 + $request->seri_4 + $request->seri_5 + $request->seri_6,
                'updated_at' => DB::raw('now()')
            ]);
            // alihkan halaman ke halaman ronde
            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return redirect('kompetisi')->with(
                Session::flash('message', 'Skor berhasil diubah')
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
