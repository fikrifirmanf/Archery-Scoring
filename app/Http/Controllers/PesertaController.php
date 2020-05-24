<?php

namespace App\Http\Controllers;

use App\Imports\PesertaImport;
use App\Kategori;
use App\Kelas;
use App\Peserta;
use App\Target;
use App\Team;
use App\Rules;
use App\Skor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class PesertaController extends Controller
{
    public function index(Request $request, $jk)
    {
        $title = "Peserta";
        $peserta = Peserta::where('peserta.jk', $jk)->join('kelas', 'peserta.uuid_kelas', '=', 'kelas.uuid')->join('team', 'peserta.uuid_team', '=', 'team.uuid')->get();

        return $this->makeResponse($request, 'peserta/peserta', compact('title', 'peserta'));
    }
    public function nasional(Request $request, $jk)
    {
        $title_page = "Peserta Nasional";

        if ($jk == 'men') {
            $title = "Data Peserta Putra";
            $peserta = Peserta::where('peserta.jk', 'L')->where('kategori', 'Nasional')->orderBy('no_target')->get();
            return $this->makeResponse($request, 'peserta/peserta', compact('title', 'peserta', 'title_page'));
        } else if ($jk == 'woman') {
            $title = "Data Peserta Putri";
            $peserta = Peserta::where('peserta.jk', 'P')->where('kategori', 'Nasional')->orderBy('no_target')->get();
            return $this->makeResponse($request, 'peserta/peserta', compact('title', 'peserta', 'title_page'));
        } else {
            return view('home')->with(compact('title'));
        }
    }
    public function recurve(Request $request, $jk)
    {
        $title_page = "Peserta Recurve";

        if ($jk == 'men') {
            $title = "Data Peserta Putra";
            $peserta = Peserta::where('peserta.jk', 'L')->where('kategori', 'Recurve')->orderBy('no_target')->get();
            return $this->makeResponse($request, 'peserta/peserta', compact('title', 'peserta', 'title_page'));
        } else if ($jk == 'woman') {
            $title = "Data Peserta Putri";
            $peserta = Peserta::where('peserta.jk', 'P')->where('kategori', 'Recurve')->orderBy('no_target')->get();
            return $this->makeResponse($request, 'peserta/peserta', compact('title', 'peserta', 'title_page'));
        } else {
            return view('home')->with(compact('title'));
        }
    }
    public function compound(Request $request, $jk)
    {
        $title_page = "Peserta Compound";

        if ($jk == 'men') {
            $title = "Data Peserta Putra";
            $peserta = Peserta::where('peserta.jk', 'L')->where('kategori', 'Compound')->join('kelas', 'peserta.uuid_kelas', '=', 'kelas.uuid')->join('no_target', 'peserta.uuid_target', '=', 'no_target.uuid')->join('kategori', 'peserta.uuid_kategori', '=', 'kategori.uuid')->orderBy('no_target')->get();
            return $this->makeResponse($request, 'peserta/peserta', compact('title', 'peserta', 'title_page'));
        } else if ($jk == 'woman') {
            $title = "Data Peserta Putri";
            $peserta = Peserta::where('peserta.jk', 'P')->where('kategori', 'Compound')->join('kelas', 'peserta.uuid_kelas', '=', 'kelas.uuid')->join('no_target', 'peserta.uuid_target', '=', 'no_target.uuid')->join('kategori', 'peserta.uuid_kategori', '=', 'kategori.uuid')->orderBy('no_target')->get();
            return $this->makeResponse($request, 'peserta/peserta', compact('title', 'peserta', 'title_page'));
        } else {
            return view('home')->with(compact('title'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $title_page = "Tambah Peserta";
        $title = "Archery Scoring";
        $team = Team::get();
        $kategori = Kategori::orderBy('nama_kategori')->get();
        $kelas = Kelas::orderBy('nama_kelas')->get();
        // $peserta = Peserta::get(['uuid_target']);
        // for ($i = 0; $i < $peserta->count(); $i++) {
        //     $ntapz[] = $peserta[$i]['uuid_target'];
        // }
        // $goks = $ntapz;



        return view('peserta/add')->with(compact('title', 'title_page', 'team', 'kategori', 'kelas'));
    }
    public function import_excel(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_peserta', $nama_file);

        // import data
        Excel::import(new PesertaImport, public_path('/file_peserta/' . $nama_file));

        // notifikasi dengan session
        Session::flash('sukses', 'Data Peserta Berhasil Diimport!');

        // alihkan halaman kembali
        return redirect('peserta/add');
    }
    public function prosesAdd(Request $request)
    {
        $cek_duplikat = Peserta::where('no_target', $request->no_target);
        if ($cek_duplikat->exists()) {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('alert-slogan', 'Gagal!');
            return redirect()->back()->with(
                Session::flash('message', 'Data peserta atau no target sudah ada, coba crosscheck!')
            );
        } else {
            Peserta::insert([
                'uuid' => Str::uuid(),
                'no_target' => $request->no_target,
                'nama_peserta' => $request->nama_peserta,
                'jk' => $request->jk,
                'kelas' => $request->kelas,
                'team' => $request->team,
                'kategori' => $request->kategori,
                'created_at' => DB::raw('now()')

            ]);
        }

        // alihkan halaman ke halaman pegawai
        Session::flash('alert-class', 'alert-success');
        Session::flash('alert-slogan', 'Sukses!');
        return redirect('peserta/add')->with(
            Session::flash('message', 'Peserta berhasil didaftar')
        );
    }
    public function update($uuid)
    {
        $title_page = "Edit Peserta";
        $title = "Archery Scoring";
        $team = Team::get();
        $kategori = Kategori::get();
        $kelas = Kelas::get();
        $peserta = Peserta::where('peserta.uuid', '1e9b-b9ac-46a8-8404-ed152dd33e12')->get();
        // $peserta = Peserta::get(['uuid_target']);
        // for ($i = 0; $i < $peserta->count(); $i++) {
        //     $ntapz[] = $peserta[$i]['uuid_target'];
        // }
        // $goks = $ntapz;
        // $target = Target::whereNotIn('uuid', $goks)->get();
        $target = Target::get();

        return view('peserta/edit')->with(compact('title_page', 'title', 'team', 'kategori', 'kelas', 'target', 'peserta'));
    }
    public function prosesEdit(Request $request)
    {
    }

    // API

    public function profile()
    {
        $uuid = Auth::id();


        $pes = Skor::where('skor.uuid_panitia', $uuid)->join('peserta', 'skor.uuid_peserta', '=', 'peserta.uuid')->join('rules', 'skor.uuid_rules', '=', 'rules.uuid')->orderBy('peserta.no_target', 'asc')->get();
        return response()->json(['peserta' => $pes], 200);
    }
}
