<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\User\KatalogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman awal
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD SISWA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:user'])->group(function () {

    // Dashboard Siswa / Katalog
    Route::get('/dashboard', [KatalogController::class, 'index'])
        ->name('dashboard');

    // Siswa melakukan peminjaman
    Route::post('/dashboard/pinjam', [KatalogController::class, 'store'])
        ->name('user.pinjam');

    // Siswa melakukan pengembalian mandiri
    Route::patch('/dashboard/kembali/{peminjaman}', [KatalogController::class, 'kembali'])
        ->name('user.kembali');
});

/*
|--------------------------------------------------------------------------
| AREA ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard Admin
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Kelola Buku
        Route::resource('buku', BukuController::class);

        // Kelola Anggota
        Route::resource('user', UserController::class);

        // Kelola Peminjaman
        Route::resource('peminjaman', PeminjamanController::class);

        // Tandai peminjaman sebagai dikembalikan
        Route::patch(
            '/peminjaman/{peminjaman}/kembali',
            [PeminjamanController::class, 'updateStatus']
        )->name('peminjaman.kembali');
    });

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';