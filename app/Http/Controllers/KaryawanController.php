<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
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
                $btn = '<button onclick="modalAction(\'' . url('/karyawan/' . $karyawan->karyawan_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn = '<button onclick="modalAction(\'' . url('/karyawan/' . $karyawan->karyawan_id . '/create_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/karyawan/' . $karyawan->karyawan_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';

                $btn .= '<button onclick="modalAction(\'' . url('/karyawan/' . $karyawan->karyawan_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi mengandung HTML
            ->make(true);
    }


    // Menambah kan data karyawan baru
    public function create()
    {
        // Return view for creating a new Karyawan
        $jabatan = Jabatan::select('id', 'nama_jabatan', 'kode_jabatan')->get();
        return view('karyawan.create_ajax')
        ->with(['jabatan' => $jabatan]);
    }

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('karyawan.edit_ajax', compact('karyawan'));
    }

    // Hapus data karyawan
    public function confirm($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('karyawan.confirm_ajax', compact('karyawan'));
    }

    public function show($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return response()->json($karyawan);
    }

    public function store_ajax(Request $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama'       => 'required|string|max:100',
                'nik'        => 'required|string|unique:karyawan|min:16|max:16',
                'kode_jabatan' => 'required|string|exists:kode_jabatan',
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
            
            Karyawan::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $karyawan = Karyawan::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'nama'       => 'required|string|max:100',
                'nik'        => 'required|string|unique:karyawan|min:16|max:16',
                'kode_jabatan' => 'required|string|exists:kode_jabatan',
                'email'      => 'required|string|max:100',
                'alamat'     => 'required|string|min:5|max:255',
                'no_telepon'    => 'required|string|min:10|max:15',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $karyawan->update($request->all());
            return response()->json([
                'status'  => true,
                'message' => 'Data karyawan berhasil diupdate'
            ]);
        }
        return redirect('/');
    }

    public function destroy_ajax($id)
    {
        if (request()->ajax()) {
            $karyawan = Karyawan::findOrFail($id);
            $karyawan->delete();
            return response()->json([
                'status'  => true,
                'message' => 'Data karyawan berhasil dihapus'
            ]);
        }
        return redirect('/karyawan');
    }
}
