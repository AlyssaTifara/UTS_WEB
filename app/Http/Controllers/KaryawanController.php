<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::with('jabatan')->get();
        return response()->json($karyawans);
    }
}
