<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//authentication route

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register',[AuthController::class,'register']);
Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('/logout',[AuthController::class,'logout']);
});
//protected route
Route::middleware(['auth:sanctum','role:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('lokasis',LokasiController::class);
});
Route::middleware(['auth:sanctum','role:manager|admin'])->group(function(){
    Route::resource('kategoris',KategoriController::class);
    Route::resource('suppliers',SupplierController::class);
    Route::resource('barangs', BarangController::class);
    Route::get('barang/dashboard', [BarangController::class,'dashboard']);
    Route::resource('mutasis',MutasiController::class);
    Route::get('history/barang/{barang}', [MutasiController::class, 'historyByBarang']);
    Route::get('history/user/{user}', [MutasiController::class, 'historyByUser']);
    Route::get('mutasi/laporan',[MutasiController::class,'laporanBulanan']);
    Route::get('mutasi/masuk',[MutasiController::class,'masukGroup']);
    Route::get('mutasi/keluar',[MutasiController::class,'keluarGroup']);
    Route::get('mutasi/transfer',[MutasiController::class,'transferGroup']);
    Route::get('lokasi',[LokasiController::class,'index']);
    Route::get('lokasi/{id}',[LokasiController::class,'show']);
});

Route::middleware(['auth:sanctum', 'permission:view mutasi'])->group(function () {
    Route::get('mutasi', [MutasiController::class, 'index']);
});

Route::middleware(['auth:sanctum','role:karyawan'])->group(function(){
    Route::get('barang/karyawan',[BarangController::class,'index']);
    Route::get('barang/karyawan/dashboard',[BarangController::class,'dashboard']);
});

Route::post('/forgot-password',[PasswordResetController::class,'forgotPassword'])->middleware('guest')->name('password.email');

// Route to handle password reset
Route::post('/reset-password',[PasswordResetController::class,'resetPassword'])->middleware('guest')->name('password.update');

