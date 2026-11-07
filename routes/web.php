<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

/*
 | Halaman tamu (belum login)
 */
Route::view('/login', 'login');
Route::view('/register', 'register');

// SEMENTARA (tahap tampilan): tanpa database, cuma mengarahkan sesuai pilihan role.
// Nanti diganti Controller yang benar-benar cek akun.
Route::post('/login', function (Request $request) {
    return redirect($request->role === 'pembeli' ? '/beranda' : '/petani/beranda');
});
Route::post('/register', function (Request $request) {
    return redirect($request->role === 'pembeli' ? '/beranda' : '/petani/beranda');
});

/*
 | Halaman PEMBELI
 */
Route::view('/beranda', 'beranda');
Route::view('/jelajahi', 'jelajahi');
Route::view('/pesanan', 'pesanan');
Route::view('/chat', 'chat');
Route::view('/profil', 'profil');

/*
 | Halaman PETANI  (alamat diawali /petani)
 */
Route::prefix('petani')->group(function () {
    Route::view('/beranda', 'petani.beranda');
    Route::view('/pesanan', 'petani.pesanan');
    Route::view('/chat', 'petani.chat');
    Route::view('/profil', 'petani.profil');
});