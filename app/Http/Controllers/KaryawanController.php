<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View; 

class KaryawanController extends Controller
{
    // Halaman awal karyawan
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Data Karyawan',
            'list'  => ['Home', 'Karyawan']
        ];

        $page = (object) [
            'title' => 'Daftar karyawan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'karyawan';

        $karyawans = Karyawan::with('jabatan')->get();

        return view('karyawan.index', [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'activeMenu' => $activeMenu,
            'karyawans'  => $karyawans
        ]);
    }


    // Data dalam bentuk tabel
    public function list(Request $request)
    {
        $karyawans = Karyawan::select('id', 'nama', 'nik', 'email', 'alamat', 'no_telepon', 'kode_jabatan')->with('jabatan');

        // Filter data karyawan berdasarkan jabatan_id
        if ($request->kode_jabatan) {
            $karyawans->where('kode_jabatan', $request->kode_jabatan);
        }

        return DataTables::of($karyawans)
            ->addIndexColumn() // menambahkan kolom index / no urut
            ->addColumn('jabatan_nama', function ($karyawans) {
                return $karyawans->jabatan->nama_jabatan ?? '-';
            })
            ->addColumn('aksi', function ($karyawans) {  
                $btn  = '<button onclick="modalAction(\'' . url('/karyawan/' . $karyawans->id . '/show') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/karyawan/' . $karyawans->id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/karyawan/' . $karyawans->id . '/delete_ajax') . '\')"  class="btn btn-danger btn-sm">Hapus</button> ';

                return $btn;
            })    
            ->rawColumns(['aksi']) 
            ->make(true);
    }


    // Menambahkan data karyawan baru
    public function create_ajax()
    {
        $jabatan = Jabatan::select('id', 'nama_jabatan', 'kode_jabatan')->get();
        return view('karyawan.create_ajax')->with(['jabatan' => $jabatan]);
    }


    // form edit ajax
        public function edit_ajax($id)
    {
        try {
            $karyawan = Karyawan::findOrFail($id);
            $jabatan = Jabatan::all();
            return view('karyawan.edit_ajax', compact('karyawan', 'jabatan'));
        } catch (\Exception $e) {
            return redirect('/karyawan')->with('error', 'Gagal mengambil data: ' . $e->getMessage());
        }
    }


    // Menampilkan detail satu karyawan berdasarkan id-nya
    public function show(string $id): View
    {
        $karyawans = Karyawan::with('jabatan')->findOrFail($id);

        $breadcrumb = (object) [
            'title' => 'Detail Karyawan',
            'list'  => ['Home', 'Karyawan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Karyawan'
        ];

        $activeMenu = 'karyawan';

        return view('karyawan.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'karyawan' => $karyawans, 'activeMenu' => $activeMenu]);
    }


    // Simpan karyawan baru
    public function store_ajax(Request $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama'       => 'required|string|max:100',
                'nik'        => 'required|string|unique:karyawan|min:6|max:16',
                'kode_jabatan' => 'required|string|exists:jabatan,id', 
                'email'      => 'required|string|max:100',
                'alamat'     => 'required|string|min:5|max:255',
                'no_telepon'    => 'required|string|min:10|max:15',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors()
                ]);
            }
            
            $jabatanId = $request->input('kode_jabatan');
            $jabatan = Jabatan::find($jabatanId);
            $kodeJabatan = $jabatan->kode_jabatan; 

            Karyawan::create(array_merge($request->except('kode_jabatan'), ['kode_jabatan' => $kodeJabatan]));

            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil disimpan'
            ]);
        }
        redirect('/karyawan');
    }


    // Mengupdate data karyawan setelah di edit
    public function update_ajax(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nama'          => 'required|string|max:100',
            'nik'           => 'required|string|unique:karyawan,nik,' . $id,
            'kode_jabatan'  => 'required|string|exists:jabatan,kode_jabatan',
            'email'         => 'required|string|email|max:100',
            'alamat'        => 'required|string|min:5|max:255',
            'no_telepon'    => 'required|string|min:10|max:15',
        ]);        

        if ($validator->fails()) {
            return response()->json([
                'status'   => false,
                'message'  => 'Validasi gagal',
                'msgField' => $validator->errors()
            ]);
        }
        try {
            $karyawan->update($request->all());
            return response()->json([
                'status'  => true,
                'message' => 'Data karyawan berhasil diupdate'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Gagal mengupdate data: ' . $e->getMessage()
            ]);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Data karyawan berhasil diupdate'
        ]);
        
        redirect('/karyawan');
    }


    // Hapus data karyawan
    public function confirm_ajax($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('karyawan.confirm_ajax', compact('karyawan'));
    }
    public function destroy_ajax($id)
    {
        try {
            $karyawan = Karyawan::findOrFail($id);
            $karyawan->delete();
            return redirect('/karyawan')->with('success', 'Data karyawan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect('/karyawan')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
    
}