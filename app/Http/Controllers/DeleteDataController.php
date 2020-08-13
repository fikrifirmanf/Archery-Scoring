<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        } else {
        }
    }
}
