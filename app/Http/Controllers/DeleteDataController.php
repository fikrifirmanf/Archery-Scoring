<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeleteDataController extends Controller
{
    public function index()
    {
        return view('delete_data/delete');
    }
    public function deleteAll($kategori)
    {
        # code...
    }
}
