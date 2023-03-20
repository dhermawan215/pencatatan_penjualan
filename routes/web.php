<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StokAwalController;
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
    return view('pages.dashboard');
});

Route::get('/dashboard', function () {
    return redirect()->route('dashboard');
})->middleware(['auth', 'verified']);

Route::prefix('/account')->middleware(['auth'])
    ->group(function () {
        Route::get('/', function () {
            return view('dashboard');
        })->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

Route::prefix('admin')->group(function () {
    Route::resource('barang', BarangController::class);
    Route::post('/barang/list_barang', [BarangController::class, 'getDataBarang']);
    Route::resource('/stok', StokAwalController::class);
    Route::post('/stok/all', [StokAwalController::class, 'getDataStok']);
});


Route::get('/sales', [PenjualanController::class, 'index'])->name('penjualan_index');
Route::get('/sales/buat_transaksi', [PenjualanController::class, 'buatTransaksi'])->name('penjualan_buat');
Route::post('/sales/simpan', [PenjualanController::class, 'simpan']);
Route::get('/sales/transaksi_detail/{sales}', [PenjualanController::class, 'transaksiDetail']);
Route::get('/sales/transaksi', [PenjualanController::class, 'lihatTransaksi'])->name('penjualan_transaksi');
Route::post('/sales/transaksiall', [PenjualanController::class, 'transaksiAll']);
Route::get('/sales/detail_transaksi/{sales}', [PenjualanController::class, 'detailTransaksi'])->name('detail_transaksi');
require __DIR__ . '/auth.php';
