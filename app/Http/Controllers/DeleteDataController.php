<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class DeleteDataController extends Controller
{
    public function index()
    {
        $title = "Reset Data";
        $title_page = "Reset Data";
        return view('delete_data/delete')->with(compact('title', 'title_page'));
    }
    public function deleteAll(Request $request)
    {
        if ($request->reset_data == 'pntskor') {
            DB::table('skor')->delete();
            DB::table('panitia')->delete();
            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return redirect()->back()->with(
                Session::flash('message', 'Reset data sukses')
            );
        } else {
            DB::table('skor')->delete();
            DB::table('peserta')->delete();
            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return redirect()->back()->with(
                Session::flash('message', 'Reset data sukses')
            );
        }
    }
}
