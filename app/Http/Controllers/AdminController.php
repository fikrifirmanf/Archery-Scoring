<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index($uuid)
    {
        $title = 'Archery Scoring';
        $title_page = 'Ubah Profil';
        $admin = Admin::where('id', $uuid)->get();

        return view('admin/edit')->with(compact('admin', 'title', 'title_page'));
    }
    public function prosesEdit(Request $request)
    {

        if ($request->password == "") {
            $this->validate($request, [
                'nama' => 'required|min:3',
                'username' => 'required|min:4',

            ]);
            Admin::where('id', $request->uuid)->update([

                'name' => $request->nama,
                'username' => $request->username,
                'created_at' => DB::raw('now()')
            ]);

            // alihkan halaman ke halaman pegawai


            Session::flush();
            return redirect('login')->with(
                'alert',
                'Profil berhasil diubah. Silahkan login kembali'
            );
        } else {
            $this->validate($request, [
                'nama' => 'required|min:3',
                'username' => 'required|min:4',
                'confirmation' => 'same:password',
            ]);
            Admin::where('id', $request->uuid)->update([

                'name' => $request->nama,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'created_at' => DB::raw('now()')
            ]);

            // alihkan halaman ke halaman pegawai


            Session::flush();
            return redirect('login')->with(
                'alert',
                'Profil berhasil diubah. Silahkan login kembali'
            );
        }
    }
}
