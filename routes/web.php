<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


use App\Http\Controllers\Admin\KelolaUserController;

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/kelola_user', [KelolaUserController::class, 'index'])->name('admin.kelola_user');
    Route::post('/kelola_user', [KelolaUserController::class, 'store'])->name('admin.kelola_user.store');
    Route::put('/kelola_user/{id}', [KelolaUserController::class, 'update'])->name('admin.kelola_user.update');
    Route::delete('/kelola_user/{id}', [KelolaUserController::class, 'destroy'])->name('admin.kelola_user.destroy');
});

use App\Http\Controllers\Admin\JadwalPosyanduController;

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/posyandu', [JadwalPosyanduController::class, 'index'])->name('admin.jadwal.index');
    Route::post('/posyandu', [JadwalPosyanduController::class, 'store'])->name('admin.jadwal.store');
    Route::put('/posyandu/{id}', [JadwalPosyanduController::class, 'update'])->name('admin.jadwal.update');
    Route::delete('/posyandu/{id}', [JadwalPosyanduController::class, 'destroy'])->name('admin.jadwal.destroy');
});


// routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::get('/orangtua/jadwal', [App\Http\Controllers\Orangtua\JadwalController::class, 'index'])->name('orangtua.jadwal');
});

use App\Http\Controllers\Admin\BalitaController;

// Prefix grup untuk admin
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/balita', [BalitaController::class, 'index'])->name('admin.balita.index');
    Route::post('/balita', [BalitaController::class, 'store'])->name('admin.balita.store');
    Route::put('/balita/{id_balita}', [BalitaController::class, 'update'])->name('admin.balita.update');
    Route::delete('/balita/{id_balita}', [BalitaController::class, 'destroy'])->name('admin.balita.destroy');
});


Route::middleware(['auth', 'role:admin,kader'])->prefix('kader')->name('kader.')->group(function () {
    Route::get('/balitaa', [App\Http\Controllers\Kader\BalitaController::class, 'index'])->name('balita.index');
    Route::post('/balitaa', [App\Http\Controllers\Kader\BalitaController::class, 'store'])->name('balita.store');
    Route::put('/balitaa/{id}', [App\Http\Controllers\Kader\BalitaController::class, 'update'])->name('balita.update');
    Route::delete('/balitaa/{id}', [App\Http\Controllers\Kader\BalitaController::class, 'destroy'])->name('balita.destroy');
});

// routes/web.php
Route::middleware(['auth', 'role:orangtua'])->prefix('orangtua')->name('orangtua.')->group(function () {
    Route::get('/balita', [App\Http\Controllers\Orangtua\BalitaController::class, 'index'])->name('balita.index');
});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/vendor', [App\Http\Controllers\Admin\VendorController::class, 'index'])->name('vendor.index');
    Route::post('/vendor', [App\Http\Controllers\Admin\VendorController::class, 'store'])->name('vendor.store');
    Route::put('/vendor/{id}', [App\Http\Controllers\Admin\VendorController::class, 'update'])->name('vendor.update');
    Route::delete('/vendor/{id}', [App\Http\Controllers\Admin\VendorController::class, 'destroy'])->name('vendor.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/vitamin', [App\Http\Controllers\Admin\VitaminController::class, 'index'])->name('vitamin.index');
    Route::post('/vitamin', [App\Http\Controllers\Admin\VitaminController::class, 'store'])->name('vitamin.store');
    Route::put('/vitamin/{id}', [App\Http\Controllers\Admin\VitaminController::class, 'update'])->name('vitamin.update');
    Route::delete('/vitamin/{id}', [App\Http\Controllers\Admin\VitaminController::class, 'destroy'])->name('vitamin.destroy');
});


use App\Http\Controllers\Admin\ImunisasiController;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/imunisasi', [ImunisasiController::class, 'index'])->name('imunisasi.index');
    Route::post('/imunisasi', [ImunisasiController::class, 'store'])->name('imunisasi.store');
    Route::put('/imunisasi/{id}', [ImunisasiController::class, 'update'])->name('imunisasi.update');
    Route::delete('/imunisasi/{id}', [ImunisasiController::class, 'destroy'])->name('imunisasi.destroy');
});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/kms', [App\Http\Controllers\Admin\KmsController::class, 'index'])->name('kms.index');
    Route::post('/kms', [App\Http\Controllers\Admin\KmsController::class, 'store'])->name('kms.store');
    Route::put('/kms/{id}', [App\Http\Controllers\Admin\KmsController::class, 'update'])->name('kms.update');
    Route::delete('/kms/{id}', [App\Http\Controllers\Admin\KmsController::class, 'destroy'])->name('kms.destroy');
});


Route::middleware(['auth', 'role:kader'])->prefix('kader')->name('kader.')->group(function () {
    Route::get('/kms', [App\Http\Controllers\Kader\KmsController::class, 'index'])->name('kms.index');
    Route::post('/kms', [App\Http\Controllers\Kader\KmsController::class, 'store'])->name('kms.store');
    Route::put('/kms/{id}', [App\Http\Controllers\Kader\KmsController::class, 'update'])->name('kms.update');
    Route::delete('/kms/{id}', [App\Http\Controllers\Kader\KmsController::class, 'destroy'])->name('kms.destroy');
});

Route::middleware(['auth', 'role:orangtua'])->prefix('orangtua')->name('orangtua.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Orangtua\DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:kader'])->prefix('kader')->name('kader.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Kader\DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
});
