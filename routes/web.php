<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\JabatanController;

use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/karyawan', [KaryawanController::class, 'index']);
Route::get('/jabatan', [JabatanController::class, 'index']);

// Grouping routes for karyawan views
Route::group(['prefix' => 'karyawan'], function () {
    Route::get('/create_ajax', [KaryawanController::class, 'create_ajax']);
    Route::post('/ajax', [KaryawanController::class, 'store_ajax']);
    Route::get('/', [KaryawanController::class, 'index']);
    Route::post('/list', [KaryawanController::class, 'list']);
    Route::get('/show/{id}', [KaryawanController::class, 'show']);
    // Route::post('/karyawan', [KaryawanController::class, 'store_ajax']); 
    // Route::post('/karyawan/update/{id}', [KaryawanController::class, 'update_ajax']); 

    Route::get('/{id}/edit_ajax', [KaryawanController::class, 'edit_ajax']); //menampilkan halaman form edit user ajax
    Route::put('/{id}/update_ajax', [KaryawanController::class, 'update_ajax']); //menyimpan perubahan data user ajax
    Route::get('/{id}/delete_ajax', [KaryawanController::class, 'confirm_ajax']); //untuk menampilkan form confirm delete user ajax
    Route::delete('/{id}/delete_ajax', [KaryawanController::class, 'delete_ajax']); //menghapus data user ajax
    Route::delete('/{id}', [KaryawanController::class, 'destroy']); //menghapus data user
});


Route::group(['prefix' => 'jabatan'], function () {
    Route::get('/create_ajax', [JabatanController::class, 'create_ajax']);
    // Route::post('/create_ajax', [KaryawanController::class, 'store_ajax']);
    Route::get('/', [JabatanController::class, 'index']);
    Route::post('/list', [JabatanController::class, 'list']);
    Route::get('/show/{id}', [JabatanController::class, 'show']);
    // Route::post('/karyawan', [KaryawanController::class, 'store_ajax']); 
    // Route::post('/karyawan/update/{id}', [KaryawanController::class, 'update_ajax']); 

    Route::get('/{id}/edit_ajax', [JabatanController::class, 'edit_ajax']); //menampilkan halaman form edit user ajax
    Route::put('/{id}/update_ajax', [JabatanController::class, 'update_ajax']); //menyimpan perubahan data user ajax
    Route::get('/{id}/delete_ajax', [JabatanController::class, 'confirm_ajax']); //untuk menampilkan form confirm delete user ajax
    Route::delete('/{id}/delete_ajax', [JabatanController::class, 'delete_ajax']); //menghapus data user ajax
    Route::delete('/{id}', [JabatanController::class, 'destroy']); //menghapus data user
});