<?php

use App\Http\Controllers\AdminLaporan;
use App\Http\Controllers\AdminTransaksi;
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
    return view('dashboard_app');
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

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('barang', BarangController::class);
    Route::post('/barang/list_barang', [BarangController::class, 'getDataBarang']);
    Route::resource('/stok', StokAwalController::class);
    Route::post('/stok/all', [StokAwalController::class, 'getDataStok']);
    Route::resource('/transaksi', AdminTransaksi::class);
    Route::post('/transaksi/data_transaksi', [AdminTransaksi::class, 'transactionData']);
    Route::get('/laporan', [AdminLaporan::class, 'index'])->name('admin_laporan_index');
    Route::post('/laporan/data_transaksi', [AdminLaporan::class, 'dataTransaksi']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/app', function () {
        return view('pages.dashboard');
    });
    Route::get('/sales', [PenjualanController::class, 'index'])->name('penjualan_index');
    Route::get('/sales/buat_transaksi', [PenjualanController::class, 'buatTransaksi'])->name('penjualan_buat');
    Route::post('/sales/simpan', [PenjualanController::class, 'simpan']);
    Route::get('/sales/transaksi_detail/{sales}', [PenjualanController::class, 'transaksiDetail']);
    Route::get('/sales/transaksi', [PenjualanController::class, 'lihatTransaksi'])->name('penjualan_transaksi');
    Route::post('/sales/transaksiall', [PenjualanController::class, 'transaksiAll']);
    Route::get('/sales/detail_transaksi/{sales}', [PenjualanController::class, 'detailTransaksi'])->name('detail_transaksi');
    Route::post('/sales/transaksi_item', [PenjualanController::class, 'transaksiItem']);
    Route::post('/sales/barang', [PenjualanController::class, 'barang']);
    Route::post('/sales/simpan_transaksi_detail', [PenjualanController::class, 'simpanTrDetail']);
    Route::delete('/sales/delete_item_tr/{sales}', [PenjualanController::class, 'deleteItemTr']);
    Route::get('/sales/success/{sales}', [PenjualanController::class, 'success']);
    Route::post('/sales/simpan_tr_total', [PenjualanController::class, 'submitTotal']);
});
require __DIR__ . '/auth.php';
