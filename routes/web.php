<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserReservasiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/data-kamar', [HomeController::class, 'kamar'])->name('beranda.kamar');
Route::get('/data-fasilitas', [HomeController::class, 'fasilitas'])->name('beranda.fasilitas');
Route::get('/data-kamar/{id}', [HomeController::class, 'showKamar'])->name('beranda.showkamar');

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::post('/kamar/pemesanan', [HomeController::class, 'pemesanan'])->name('home.pemesanan');
    Route::resource('dashboard', DashboardController::class);
    Route::get('pemesanan/cetak-resi/{id}', [UserReservasiController::class, 'cetakResi'])->name('pemesanan.cetak');
    Route::resource('pemesanan', UserReservasiController::class);
    Route::middleware(['admin'])->group(function () {
        Route::get('api/reservasi/get-status/{id}', [ReservasiController::class, 'getStatus'])->name('api.getstatus');
        Route::get('api/kamar-fasilitas/{id}', [KamarController::class, 'kamarFasilitas'])->name('api.kamarfasilitas');
        Route::put('/reservasi/edit-status/{id}', [ReservasiController::class, 'editStatus']);

        Route::resource('user', UserController::class);
        Route::resource('fasilitas', FasilitasController::class);
        Route::resource('kamar', KamarController::class);
        Route::resource('reservasi', ReservasiController::class);
    });
});