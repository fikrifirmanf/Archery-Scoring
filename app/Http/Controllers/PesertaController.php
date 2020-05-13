<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\Kelas;
use App\Peserta;
use App\Target;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


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
            $peserta = Peserta::where('peserta.jk', 'Laki-laki')->where('kategori.nama_kategori', 'Nasional')->join('kelas', 'peserta.uuid_kelas', '=', 'kelas.uuid')->join('team', 'peserta.uuid_team', '=', 'team.uuid')->join('kategori', 'peserta.uuid_kategori', '=', 'kategori.uuid')->join('no_target', 'peserta.uuid_target', '=', 'no_target.uuid')->get();
            return $this->makeResponse($request, 'peserta/peserta', compact('title', 'peserta', 'title_page'));
        } else if ($jk == 'woman') {
            $title = "Data Peserta Putri";
            $peserta = Peserta::where('peserta.jk', 'Perempuan')->where('kategori.nama_kategori', 'Nasional')->join('kelas', 'peserta.uuid_kelas', '=', 'kelas.uuid')->join('team', 'peserta.uuid_team', '=', 'team.uuid')->join('kategori', 'peserta.uuid_kategori', '=', 'kategori.uuid')->join('no_target', 'peserta.uuid_target', '=', 'no_target.uuid')->get();
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
            $peserta = Peserta::where('peserta.jk', 'Laki-laki')->where('kategori.nama_kategori', 'Recurve')->join('kelas', 'peserta.uuid_kelas', '=', 'kelas.uuid')->join('team', 'peserta.uuid_team', '=', 'team.uuid')->join('kategori', 'peserta.uuid_kategori', '=', 'kategori.uuid')->join('no_target', 'peserta.uuid_target', '=', 'no_target.uuid')->get();
            return $this->makeResponse($request, 'peserta/peserta', compact('title', 'peserta', 'title_page'));
        } else if ($jk == 'woman') {
            $title = "Data Peserta Putri";
            $peserta = Peserta::where('peserta.jk', 'Perempuan')->where('kategori.nama_kategori', 'Recurve')->join('kelas', 'peserta.uuid_kelas', '=', 'kelas.uuid')->join('team', 'peserta.uuid_team', '=', 'team.uuid')->join('kategori', 'peserta.uuid_kategori', '=', 'kategori.uuid')->join('no_target', 'peserta.uuid_target', '=', 'no_target.uuid')->get();
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
            $peserta = Peserta::where('peserta.jk', 'Laki-laki')->where('kategori.nama_kategori', 'Compound')->join('kelas', 'peserta.uuid_kelas', '=', 'kelas.uuid')->join('no_target', 'peserta.uuid_target', '=', 'no_target.uuid')->join('team', 'peserta.uuid_team', '=', 'team.uuid')->join('kategori', 'peserta.uuid_kategori', '=', 'kategori.uuid')->get();
            return $this->makeResponse($request, 'peserta/peserta', compact('title', 'peserta', 'title_page'));
        } else if ($jk == 'woman') {
            $title = "Data Peserta Putri";
            $peserta = Peserta::where('peserta.jk', 'Perempuan')->where('kategori.nama_kategori', 'Compound')->join('kelas', 'peserta.uuid_kelas', '=', 'kelas.uuid')->join('no_target', 'peserta.uuid_target', '=', 'no_target.uuid')->join('team', 'peserta.uuid_team', '=', 'team.uuid')->join('kategori', 'peserta.uuid_kategori', '=', 'kategori.uuid')->get();
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
        $kategori = Kategori::get();
        $kelas = Kelas::get();
        $peserta = Peserta::get(['uuid_target']);
        for ($i = 0; $i < $peserta->count(); $i++) {
            $ntapz[] = $peserta[$i]['uuid_target'];
        }
        $goks = $ntapz;
        $target = Target::whereNotIn('uuid', $goks)->get();


        return view('peserta/add')->with(compact('title', 'title_page', 'team', 'kategori', 'kelas', 'target'));
    }
    public function prosesAdd(Request $request)
    {
        if (Peserta::where('uuid_target', '=', $request->uuid_target)->exists()) {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('alert-slogan', 'Gagal!');
            return redirect()->back()->with(
                Session::flash('message', 'Data peserta sudah ada!')
            );
        } else {
            Peserta::insert([
                'uuid' => Str::uuid(),
                'uuid_target' => $request->uuid_target,
                'nama_peserta' => $request->nama_peserta,
                'jk' => $request->jk,
                'uuid_kelas' => $request->uuid_kelas,
                'uuid_team' => $request->uuid_team,
                'uuid_kategori' => $request->uuid_kategori,

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
        // $uuid = Auth::id();
        $peserta = Peserta::get();

        return response()->json(['peserta' => $peserta], 200);
    }
}
