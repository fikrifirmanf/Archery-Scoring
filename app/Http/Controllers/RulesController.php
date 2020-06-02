<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\Kelas;
use App\Ronde;
use App\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class RulesController extends Controller
{
    public function index(Request $request)
    {
        $title = "Rules";
        $title_page = "Pengaturan";
        $rules = Rules::join('kategori', 'rules.uuid_kategori', '=', 'kategori.uuid')->select('rules.*',  'kategori.nama_kategori')->orderBy('kategori.nama_kategori', 'asc')->orderBy('nama', 'asc')->get();


        return $this->makeResponse($request, 'rules/rules', compact('title', 'rules', 'title_page'));
    }
    public function create()
    {
        $title = 'Archery Scoring';
        $title_page = 'Tambah Rules';
        $ronde = Ronde::get();
        $kelas = Kelas::get();
        $kategori = Kategori::get();
        return view('rules/add')->with(compact('title', 'title_page', 'ronde', 'kelas', 'kategori'));
    }
    public function prosesAdd(Request $request)
    {
        $rules_exist = Rules::where('nama', Ronde::where('uuid', $request->uuid_ronde)->value('nama_ronde') . ' ' . Kelas::where('uuid', $request->uuid_kelas)->value('nama_kelas'))->where('uuid_kategori', $request->uuid_kategori)->first();
        if (!$rules_exist) {
            try {
                Rules::insert([
                    'uuid' => Str::uuid(),
                    'nama' => Ronde::where('uuid', $request->uuid_ronde)->value('nama_ronde') . ' ' . Kelas::where('uuid', $request->uuid_kelas)->value('nama_kelas'),
                    'jml_seri' => $request->jml_seri,
                    'jml_panah' => $request->jml_panah,
                    'uuid_ronde' => $request->uuid_ronde,
                    'jarak' => $request->jarak,
                    'uuid_kelas' => $request->uuid_kelas,
                    'uuid_kategori' => $request->uuid_kategori,
                    'jml_peserta' => $request->jml_peserta,
                    'input' => $request->input_data,
                    'created_at' => DB::raw('now()')
                ]);
                // alihkan halaman ke halaman ronde
                Session::flash('alert-class', 'alert-success');
                Session::flash('alert-slogan', 'Sukses!');
                return redirect('rules/add')->with(
                    Session::flash('message', 'Rules berhasil dibuat')
                );
            } catch (\Throwable $th) {
                throw $th;
            }
        } else {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('alert-slogan', 'Gagal!');
            return redirect('rules/add')->with(
                Session::flash('message', 'Data rules sudah ada!')
            );
        }
    }

    public function update($uuid)
    {

        $title = 'Archery Scoring';
        $title_page = 'Edit Rules';
        $rules = Rules::where('uuid', $uuid)->get();
        return view('rules/edit')->with(compact('title', 'rules', 'title_page'));
    }

    public function prosesEdit(Request $request)
    {
        try {
            Rules::where('uuid', $request->uuid)->update([
                'nama' => Ronde::where('uuid', $request->uuid_ronde)->value('nama_ronde') . ' ' . Kelas::where('uuid', $request->uuid_kelas)->value('nama_kelas'),
                'jml_seri' => $request->jml_seri,
                'jml_panah' => $request->jml_panah,
                'uuid_ronde' => $request->uuid_ronde,
                'jarak' => $request->jarak,
                'uuid_kelas' => $request->uuid_kelas,
                'uuid_kategori' => $request->uuid_kategori,
                'jml_peserta' => $request->jml_peserta,
                'input' => $request->input_data,
                'updated_at' => DB::raw('now()')
            ]);
            // alihkan halaman ke halaman ronde
            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return redirect('rules/edit')->with(
                Session::flash('message', 'Rules berhasil diubah')
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function del($uuid)
    {

        try {
            Rules::where('uuid', $uuid)->delete();
            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return redirect('rules')->with(
                Session::flash('message', 'Data rules berhasil dihapus')
            );
        } catch (\Throwable $th) {
            throw $th;
            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return redirect('rules')->with(
                Session::flash('message', 'Data rules gagal dihapus!')
            );
        }
    }
}
