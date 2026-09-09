<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;

// Rute Tamu / Guest (Login & Register)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Rute Logout (Bisa POST atau GET untuk kemudahan di navbar)
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

// Rute yang membutuhkan Login (Admin & User Biasa)
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    // User Biasa & Admin dapat melihat daftar barang beserta kategorinya (satu page dan tabel yang sama)
    Route::get('/daftar-barang', [BarangController::class, 'tampil'])->name('daftar-barang');

    // Rute Khusus ADMIN (CRUD Barang & Kategori)
    Route::middleware('role:Admin')->group(function () {
        // CRUD Barang (Create, Edit, Update, Delete)
        Route::get('/tambah-barang', [BarangController::class, 'create'])->name('tambah-barang');
        Route::post('/simpan-barang', [BarangController::class, 'simpan'])->name('simpan-barang');
        Route::get('/ubah-barang/{id}', [BarangController::class, 'ubah'])->name('barang.ubah');
        Route::put('/update-barang/{id}', [BarangController::class, 'update'])->name('barang.update');
        Route::delete('/hapus-barang/{id}', [BarangController::class, 'hapus'])->name('barang.hapus');

        // CRUD Kategori
        Route::get('/daftar-kategori', [KategoriController::class, 'tampil'])->name('daftar-kategori');
        Route::get('/tambah-kategori', [KategoriController::class, 'create'])->name('tambah-kategori');
        Route::post('/simpan-kategori', [KategoriController::class, 'simpan'])->name('simpan-kategori');
        Route::get('/ubah-kategori/{kategori}', [KategoriController::class, 'ubah'])->name('kategori.ubah');
        Route::put('/update-kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/hapus-kategori/{kategori}', [KategoriController::class, 'hapus'])->name('kategori.hapus');
    });
});