<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik')->unique();
            $table->string('email')->unique();
            $table->string('alamat')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('kode_jabatan');
            $table->foreign('kode_jabatan')->references('kode_jabatan')->on('jabatan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('karyawan');
    }
};