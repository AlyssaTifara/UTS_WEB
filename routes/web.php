<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\JabatanController;

use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/karyawan', [KaryawanController::class, 'index']);
Route::get('/jabatan', [JabatanController::class, 'index']);
