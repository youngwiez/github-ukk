<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;

Route::get('/', function () {
    return view('login');
});

Route::get('login', [LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class,'authenticate']);

Route::get('logout', [LoginController::class,'logout']);
Route::post('logout', [LoginController::class,'logout']);

Route::post('register', [RegisterController::class,'store']);
Route::get('register', [RegisterController::class,'create']);

Route::resource('kategori', KategoriController::class)->middleware('auth');
Route::resource('barang', BarangController::class)->middleware('auth');
Route::resource('pemasukan', PemasukanController::class)->middleware('auth');
Route::resource('pengeluaran', PengeluaranController::class)->middleware('auth');

// Route::get('kategori/search', [KategoriController::class, 'search']);
