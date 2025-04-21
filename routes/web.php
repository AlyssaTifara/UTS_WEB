<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
Route::get('/jabatan', [JabatanController::class, 'index'])->name('jabatan.index');

// Route Karyawan
Route::prefix('karyawan')->group(function () {
    Route::get('/', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::post('/list', [KaryawanController::class, 'list'])->name('karyawan.list');

    Route::get('/create_ajax', [KaryawanController::class, 'create_ajax'])->name('karyawan.create_ajax');
    Route::post('/ajax', [KaryawanController::class, 'store_ajax'])->name('karyawan.store_ajax');

    Route::get('/{id}/edit_ajax', [KaryawanController::class, 'edit_ajax'])->name('karyawan.edit_ajax');
    Route::put('/{id}/update_ajax', [KaryawanController::class, 'update_ajax'])->name('karyawan.update_ajax');

    Route::get('/{id}/delete_ajax', [KaryawanController::class, 'confirm_ajax'])->name('karyawan.confirm_ajax');
    Route::delete('/{id}/delete_ajax', [KaryawanController::class, 'destroy_ajax'])->name('karyawan.delete_ajax');
});

// Route Jabatan
Route::prefix('jabatan')->group(function () {
    Route::get('/', [JabatanController::class, 'index'])->name('jabatan.index');
    Route::post('/list', [JabatanController::class, 'list'])->name('jabatan.list');

    Route::get('/create_ajax', [JabatanController::class, 'create_ajax'])->name('jabatan.create_ajax');
    Route::post('/ajax', [JabatanController::class, 'store_ajax'])->name('jabatan.store_ajax');

    Route::get('/{id}/edit_ajax', [JabatanController::class, 'edit_ajax'])->name('jabatan.edit_ajax');
    Route::put('/{id}/update_ajax', [JabatanController::class, 'update_ajax'])->name('jabatan.update_ajax');

    Route::get('/{id}/delete_ajax', [JabatanController::class, 'confirm_ajax'])->name('jabatan.confirm_ajax');
    Route::delete('/{id}/delete_ajax', [JabatanController::class, 'destroy_ajax'])->name('jabatan.delete_ajax');
});