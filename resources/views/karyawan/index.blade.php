@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('karyawan/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah Karyawan</button>
            </div>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-bordered table-striped table-hover table-sm" id="table_karyawan">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Jabatan</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" 
        data-backdrop="static" data-keyboard="false" data-width="75%">
    </div>
@endsection

@push('css')
@endpush

@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }
    var dataKaryawan;
    $(document).ready(function() {
        dataKaryawan = $('#table_karyawan').DataTable({
            serverSide: true,
            ajax: {
                    "url": "{{ url('karyawan/list') }}",
                    "dataType": "json",
                    "type": "POST"
                },
            columns: [
                {
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "nama",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "nik",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "jabatan_nama",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "email",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "alamat",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "no_telepon",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
@endpush