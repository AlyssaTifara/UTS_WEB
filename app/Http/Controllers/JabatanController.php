<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class JabatanController extends Controller
{
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

        // $karyawans = Jabatan::with('jabatan')->get();
        $jabatans = Jabatan::all();

        return view('jabatan.index', [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'activeMenu' => $activeMenu,
            'jabatans'   => $jabatans
        ]);
    }

    public function list(Request $request)
    {
        $jabatan = Jabatan::select(['id', 'nama_jabatan', 'kode_jabatan', 'deskripsi']); //Select the fields required

        return DataTables::of($jabatan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($jabatan) {
                $btn = '<button onclick="modalAction(\'' . url('/jabatan/' . $jabatan->id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/jabatan/' . $jabatan->id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/jabatan/' . $jabatan->id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create_ajax()
    {
        return view('jabatan.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $validator = Validator::make($request->all(), [
                'nama_jabatan' => 'required|string|max:255|unique:jabatan,nama_jabatan',
                'kode_jabatan' => 'required|string|max:255|unique:jabatan,kode_jabatan',
                'deskripsi'    => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi gagal',
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

    public function edit_ajax($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        return view('jabatan.edit_ajax', compact('jabatan'));
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $jabatan = Jabatan::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'nama_jabatan' => 'required|string|max:255|unique:jabatan,nama_jabatan,'.$id,
                'kode_jabatan' => 'required|string|max:255|unique:jabatan,kode_jabatan,'.$id,
                'deskripsi'    => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $jabatan->update($request->all());
            return response()->json([
                'status'  => true,
                'message' => 'Data jabatan berhasil diupdate'
            ]);
        }
        return redirect('/jabatan');
    }

    public function confirm_ajax($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        return view('jabatan.confirm_ajax', compact('jabatan'));
    }

    public function destroy_ajax($id)
    {
        if (request()->ajax()) {
            $jabatan = Jabatan::findOrFail($id);
            $jabatan->delete();
            return response()->json([
                'status'  => true,
                'message' => 'Data jabatan berhasil dihapus'
            ]);
        }
        return redirect('/jabatan');
    }
}
