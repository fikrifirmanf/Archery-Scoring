<?php

namespace App\Http\Controllers;

use App\Target;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class TargetController extends Controller
{
    public function index(Request $request)
    {
        $title = "Target";
        $title_page = "Pengaturan";
        $target = Target::get();
        $targeet = Target::value('no_target');
        $katList = explode(',', $targeet);
        return $this->makeResponse($request, 'target/target', compact('title', 'katList', 'target', 'title_page'));
    }
    public function update($uuid)
    {
        $title = 'Archery Scoring';
        $title_page = 'Ubah no target';
        $target = Target::where('uuid', $uuid)->get();
        return view('target/edit')->with(compact('title', 'target', 'title_page'));
    }
    public function prosesEdit(Request $request)
    {
        try {
            Target::where('uuid', $request->uuid)->update([
                'no_target' => $request->no_target,
                'updated_at' => DB::raw('now()')

            ]);
            Session::flash('alert-class', 'alert-success');
            Session::flash('alert-slogan', 'Sukses!');
            return redirect()->back()->with(
                Session::flash('message', 'No target berhasil diubah')
            );
        } catch (\Throwable $th) {
            //throw $th;
            throw $th;
        }
    }
}
