<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatans = Jabatan::all();
        return response()->json($jabatans);
    }
}
