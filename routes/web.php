<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest:karyawan'])->group(function(){
    Route::get('/', function () {
        return view('login');
    })->name('login');

    Route::post('proses-login', [AuthController::class, 'prosesLogin']);
});

Route::middleware(['guest'])->group(function(){
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');

    Route::post('proses-login', [AuthController::class, 'prosesLogin']);
});

Route::middleware(['auth:karyawan'])->group(function(){
    Route::get('dashboard', [PresensiController::class, 'index'])->name('dashboard');
    Route::get('presensi/create', [PresensiController::class, 'create'])->name('presensi.create');
    Route::post('presensi/store', [PresensiController::class, 'store'])->name('presensi.store');

    Route::get('presensi/edit-profile', [PresensiController::class, 'editProfile'])->name('presensi.edit-profile');
    Route::post('presensi/{nik}/update-profile', [PresensiController::class, 'updateProfile'])->name('presensi.update-profile');

    Route::get('presensi/history', [PresensiController::class, 'history'])->name('presensi.history');
    Route::post('gethistory', [PresensiController::class, 'getHistory'])->name('get-history');

    Route::get('/presensi/izin', [PresensiController::class, 'izin'])->name('presensi.izin');
    Route::get('/presensi/buatizin', [PresensiController::class, 'buatizin'])->name('presensi.buatizin');
    Route::post('/presensi/storeizin', [PresensiController::class, 'storeizin'])->name('presensi.storeizin');


    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

});

Route::get('dashboardadmin', [DashboardController::class, 'index']);
