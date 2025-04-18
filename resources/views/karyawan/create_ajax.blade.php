<form action="{{ url('/karyawan/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Karyawan</label>
                    <input value="" type="text" name="nama" id="nama" class="form-control" required>
                    <small id="error-name" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>NIK Karyawan</label>
                    <input value="" type="text" name="nik" id="nik" class="form-control" required>
                    <small id="error-nik" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <select name="kode_jabatan" id="kode_jabatan" class="form-control" required>
                        <option value="">- Pilih Jabatan -</option>
                        @foreach ($jabatan as $j)
                            <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                        @endforeach
                    </select>
                    <small id="error-kode_jabatan" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input value="" type="email" name="email" id="email" class="form-control" required>
                    <small id="error-email" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input value="" type="text" name="alamat" id="alamat" class="form-control" required>
                    <small id="error-alamat" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Telepon</label>
                    <input value="" type="text" name="no_telepon" id="no_telepon" class="form-control" required>
                    <small id="error-no_telepon" class="error-text form-text text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $("#form-tambah").validate({
            rules: {
                nama: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                nik: {
                    required: true,
                    minlength: 6,  
                    maxlength: 16
                },
                email: {
                    required: true,
                    email: true
                },
                alamat: {
                    required: true,
                    minlength: 5,
                    maxlength: 255
                },
                kode_jabatan: {
                    required: true
                },
                no_telepon: {
                    required: true,
                    minlength: 10,
                    maxlength: 15
                }
            },
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataKaryawan.ajax.reload();
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>