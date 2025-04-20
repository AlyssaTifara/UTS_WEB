<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View; // Import kelas View
use Illuminate\Http\JsonResponse; // Import kelas JsonResponse
use Illuminate\Http\RedirectResponse; // Import kelas RedirectResponse

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
        $karyawans = Karyawan::select('nama', 'nik', 'email', 'alamat', 'no_telepon', 'kode_jabatan')->with('jabatan');

        // Filter data karyawan berdasarkan jabatan_id jika tersedia
        if ($request->kode_jabatan) {
            $karyawans->where('kode_jabatan', $request->kode_jabatan);
        }

        return DataTables::of($karyawans)
            ->addIndexColumn() // menambahkan kolom index / no urut
            ->addColumn('jabatan_nama', function ($karyawans) {
                return $karyawans->jabatan->nama_jabatan ?? '-';
            })
            ->addColumn('aksi', function ($karyawan) {
                $btn = '<button onclick="modalAction(\'' . url('/karyawan/' . $karyawan->karyawan_id . '/show') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                // $btn = '<button onclick="modalAction(\'' . url('/karyawan/' . $karyawan->karyawan_id . '/create_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/karyawan/' . $karyawan->karyawan_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/karyawan/' . $karyawan->karyawan_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) 
            ->make(true);
    }


    // Menambah kan data karyawan baru
    public function create_ajax()
    {
        // Return view for creating a new Karyawan
        $jabatan = Jabatan::select('id', 'nama_jabatan', 'kode_jabatan')->get();
        return view('karyawan.create_ajax')->with(['jabatan' => $jabatan]);
    }

    // form edit ajax
    public function edit_ajax($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $jabatan = Jabatan::all();
        return view('karyawan.edit_ajax', compact('karyawan', 'jabatan'));
    }

    // Hapus data karyawan
    public function confirm_ajax($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('karyawan.confirm_ajax', compact('karyawan'));
    }

    // Menampilkan detail data karyawan 
    // public function show($id)
    // {
    //     $karyawan = Karyawan::with('jabatan')->findOrFail($id);
    //     return response()->json($karyawan); 
    // }

    public function show(string $id): View
    {
        $karyawan = Karyawan::with('jabatan')->findOrFail($id);

        $breadcrumb = (object) [
            'title' => 'Detail Karyawan',
            'list'  => ['Home', 'Karyawan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Karyawan'
        ];

        $activeMenu = 'karyawan';

        return view('karyawan.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'karyawan' => $karyawan, 'activeMenu' => $activeMenu]);
        // return view('karyawan.show', compact('karyawan')); // Ini juga benar
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
            
            // Gunakan DB::transaction untuk memastikan atomicity
        try {
            DB::beginTransaction();
            Karyawan::create(array_merge($request->except('kode_jabatan'), ['kode_jabatan' => $kodeJabatan]));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage(),
            ], 500); // Kode status 500 untuk server error
        }

            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil disimpan'
            ]);
        }
        redirect('/');
    }
    

    // Mengupdate data karyawan
    public function update_ajax(Request $request, $id)
    {
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'nama'       => 'required|string|max:100',
            'nik'        => 'required|string|unique:karyawan,nik,' . $id . ',karyawan_id', 
            'kode_jabatan' => 'required|string|exists:jabatan,id',
            'email'      => 'required|string|email|max:100',  
            'alamat'     => 'required|string|min:5|max:255',
            'no_telepon' => 'required|string|min:10|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message'  => 'Validasi gagal',
                'msgField' => $validator->errors()
            ]);
        }

        $karyawan = Karyawan::findOrFail($id);

         // Gunakan DB::transaction untuk memastikan atomicity
        try {
            DB::beginTransaction();
            $karyawan->update(array_merge($request->except('kode_jabatan'),['kode_jabatan' => $request->kode_jabatan]));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat mengupdate data: ' . $e->getMessage(),
            ], 500); // Kode status 500 untuk server error
        }

        return response()->json([
            'status'  => true,
            'message' => 'Data karyawan berhasil diupdate'
        ]);
    }

    // hapus ajax
    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $karyawan = Karyawan::find($id);

            if (!$karyawan) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data karyawan tidak ditemukan'
                ]);
            }

            $karyawan->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data karyawan berhasil dihapus'
            ]);
        }

        return redirect('/');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();
        return redirect('/karyawan');
    }
}