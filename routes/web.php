<?php

use App\Http\Controllers\AdminBarangController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPembayaranController;
use App\Http\Controllers\AdminPesananController;
use App\Http\Controllers\CustomerBarangController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerPembayaranController;
use App\Http\Controllers\CustomerPesananController;
use App\Http\Controllers\LaporanPesananController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\ProfileController;
use App\Models\Pembayaran;
use App\Models\Pesanan;
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
    return view('auth.login');
});
Route::get('/admin/kirim-pesan-jatuh-tempo', [AdminDashboardController::class, 'kirimPesanJatuhTempo']);
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::get('/customer/dashboard', function () {
    $totalPesanan  = Pesanan::where('hidden', false)->where('user_id', auth()->id())->count();
    $pembayaranProses  = Pembayaran::where('user_id', auth()->id())->where('status', 'diproses')->count();
    return view('customer.dashboard', compact('pembayaranProses', 'totalPesanan'));
})->middleware(['auth', 'verified'])->name('customer.dashboard');

Route::get('/pimpinan/dashboard', function () {
    return view('pimpinan.dashboard');
})->middleware(['auth', 'verified'])->name('pimpinan.dashboard');

Route::middleware('auth')->group(function () {
    // Admin
    Route::get('/admin/master-data/customers', [CustomerController::class, 'index'])->name('admin.customers.index');
    Route::get('/admin/master-data/customers/{user}/delete', [CustomerController::class, 'destroy'])->name('admin.customers.destroy');

    Route::get('/admin/master-data/pimpinan', [PimpinanController::class, 'index'])->name('admin.pimpinan.index');
    Route::get('/admin/master-data/pimpinan/create', [PimpinanController::class, 'create'])->name('admin.pimpinan.create');
    Route::get('/admin/master-data/pimpinan/{user}/delete', [PimpinanController::class, 'destroy'])->name('admin.pimpinan.destroy');

    Route::get('/admin/master-data/barang', [AdminBarangController::class, 'index'])->name('admin.barang.index');
    Route::post('/admin/master-data/barang', [AdminBarangController::class, 'store'])->name('admin.barang.store');
    Route::get('/admin/master-data/barang/create', [AdminBarangController::class, 'create'])->name('admin.barang.create');
    Route::get('/admin/master-data/barang/{barang}', [AdminBarangController::class, 'show'])->name('admin.barang.show');
    Route::get('/admin/master-data/barang/{barang}/delete', [AdminBarangController::class, 'destroy'])->name('admin.barang.destroy');

    Route::get('/admin/pesanan', [AdminPesananController::class, 'index'])->name('admin.pesanan.index');
    Route::get('/admin/pesanan/{pesanan}/terima', [AdminPesananController::class, 'terima'])->name('admin.pesanan.terima');
    Route::get('/admin/pesanan/{pesanan}/tolak', [AdminPesananController::class, 'tolak'])->name('admin.pesanan.tolak');

    Route::get('/admin/pembayaran', [AdminPembayaranController::class, 'index'])->name('admin.pembayaran.index');
    Route::get('/admin/pembayaran/{pembayaran}/terima', [AdminPembayaranController::class, 'terima'])->name('admin.pembayaran.terima');
    Route::get('/admin/pembayaran/{pembayaran}/tolak', [AdminPembayaranController::class, 'tolak'])->name('admin.pembayaran.tolak');
    Route::get('/admin/pembayaran/{pembayaran}/hapus-utang', [AdminPembayaranController::class, 'hapusHutang'])->name('admin.pembayaran.hapus-utang');

    // Customer
    Route::get('/customer/barang', [CustomerBarangController::class, 'index'])->name('customer.barang.index');

    Route::get('/customer/pesanan', [CustomerPesananController::class, 'index'])->name('customer.pesanan.index');
    Route::get('/customer/pesanan/keranjang', [CustomerPesananController::class, 'keranjang'])->name('customer.pesanan.keranjang');
    Route::get('/keranjang/delete/{keranjang}', [CustomerPesananController::class, 'deleteKeranjang'])->name('customer.pesanan.keranjang.delete');
    Route::get('/customer/pesanan/create', [CustomerPesananController::class, 'create'])->name('customer.pesanan.create');
    Route::post('/customer/pesanan', [CustomerPesananController::class, 'store'])->name('customer.pesanan.store');
    Route::get('/customer/pesanan-store', [CustomerPesananController::class, 'storeTransaksi'])->name('customer.pesanan.store-pesanan');
    Route::get('/customer/pesanan/{pesanan}/delete', [CustomerPesananController::class, 'destroy'])->name('customer.pesanan.destroy');



    Route::get('/customer/pembayaran', [CustomerPembayaranController::class, 'index'])->name('customer.pembayaran.index');
    Route::post('/customer/pembayaran/pesanan/{pesanan}', [CustomerPembayaranController::class, 'store'])->name('customer.pembayaran.store');

    // Pimpinan & Admin
    Route::get('/laporan/pesanan', [LaporanPesananController::class, 'index'])->name('laporan.pesanan.index');
    Route::get('/laporan/pesanan/cetak', [LaporanPesananController::class, 'cetak'])->name('laporan.pesanan.cetak');


    // All
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
