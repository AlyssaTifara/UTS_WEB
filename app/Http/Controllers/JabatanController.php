<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class JabatanController extends Controller
{
    // Halaman utama jabatan
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Data Jabatan',
            'list'  => ['Home', 'Jabatan']
        ];

        $page = (object) [
            'title' => 'Daftar Jabatan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'Jabatan';
        $jabatans = Jabatan::all();

        return view('jabatan.index', [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'activeMenu' => $activeMenu,
            'jabatans'   => $jabatans
        ]);
    }

    // Data jabatan
    public function list(Request $request)
    {
        $jabatan = Jabatan::select(['id', 'nama_jabatan', 'kode_jabatan', 'deskripsi']); //Select the fields required

        return DataTables::of($jabatan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($jabatan) {
                $btn = '<button onclick="modalAction(\'' . url('/jabatan/' . $jabatan->id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/jabatan/' . $jabatan->id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Menambah jabatan baru 
    public function create_ajax(){
        return view('jabatan.create_ajax');
    }

    // Simpan karyawan baru
    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama_jabatan' => 'required|string|max:255|unique:jabatan,nama_jabatan',
                'kode_jabatan' => 'required|string|max:255|unique:jabatan,kode_jabatan',
                'deskripsi'    => 'nullable|string',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            Jabatan::create($request->all());

            return response()->json([
                'status'  => true,
                'message' => 'Data jabatan berhasil disimpan'
            ]);
        }

        return redirect('/jabatan');
    }


    public function show($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        return response()->json($jabatan);
    }


    //Mengedit data jabatan 
    public function edit_ajax($id)
    {
        try {
            $jabatan = Jabatan::findOrFail($id);
            return view('jabatan.edit_ajax', compact('jabatan'));
        } catch (\Exception $e) {
            return redirect('/jabatan')->with('error', 'Gagal memuat data: ' . $e->getMessage());
        }
    }


    //Mengupdate data jabatan
    public function update_ajax(Request $request, $id)
    {
        $jabatan = Jabatan::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_jabatan' => 'required|string|max:255|unique:jabatan,nama_jabatan,' . $id,
            'kode_jabatan' => 'required|string|max:255|unique:jabatan,kode_jabatan,' . $id,
            'deskripsi'    => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect('/jabatan')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validasi gagal.');
        }

        try {
            $jabatan->update($request->all());
            return redirect('/jabatan')->with('success', 'Data jabatan berhasil diupdate.');
        } catch (\Exception $e) {
            return redirect('/jabatan')->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
        }
    }


    // hapus ajax
    public function confirm_ajax($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        return view('jabatan.confirm_ajax', compact('jabatan'));
    }
    public function destroy_ajax($id)
    {
        try {
            $jabatan = Jabatan::findOrFail($id);
            $jabatan->delete();
            return redirect('/jabatan')->with('success', 'Data karyawan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect('/jabatan')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
