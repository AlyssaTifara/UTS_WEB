<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'kode_jabatan',
        'nama_jabatan',
        'deskripsi',
    ];

    public function karyawans()
    {
        return $this->hasMany(Karyawan::class, 'kode_jabatan', 'kode_jabatan');
    }
}
