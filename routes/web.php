<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\InputAspirasiController;
use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login-admin', [AuthController::class, 'showLoginAdmin'])->name('admin.login');
Route::post('/login-admin', [AuthController::class, 'loginAdmin'])->name('admin.login.submit');
Route::get('/register-siswa', [AuthController::class, 'showRegisterSiswa'])->name('siswa.register');
Route::post('/register-siswa', [AuthController::class, 'registerSiswa'])->name('siswa.register.submit');
Route::get('/login-siswa', [AuthController::class, 'showLoginSiswa'])->name('siswa.login');
Route::post('/login-siswa', [AuthController::class, 'loginSiswa'])->name('siswa.login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//siswa
Route::get('/siswa/dashboard', [InputAspirasiController::class, 'index'])->name('siswa.dashboard');
Route::post('/aspirasi/store', [InputAspirasiController::class, 'store'])->name('aspirasi.store');
Route::get('/siswa/aspirasi/{id}', [InputAspirasiController::class, 'show'])->name('aspirasi.show');

Route::middleware(['is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AspirasiController::class, 'index'])->name('admin.dashboard');

    //update status
    Route::post('/admin/update-status/{id}', [AspirasiController::class, 'updateStatus'])->name('admin.update-status');

    //kategori
    Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/admin/kategori', [KategoriController::class, 'store'])->name('kategori.store');

    //fitbek
    Route::get('/admin/feedback/{id}', [AspirasiController::class, 'feedback'])->name('admin.feedback');
    Route::post('/admin/feedback/update/{id}', [AspirasiController::class, 'updateFeedback'])->name('admin.feedback.update');
});