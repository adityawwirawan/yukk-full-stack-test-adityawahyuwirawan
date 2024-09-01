<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\HistoryController;


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
    return redirect('/login');
});

Route::get('/register', [UserController::class, 'showRegistrationForm']);
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/login', [UserController::class, 'showLoginForm']);
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/transaksi', [TransactionController::class, 'index'])->name('transaksi')->middleware('auth');
Route::get('/tambah-transaksi', [TransactionController::class, 'tambahTransaksi'])->name('transaksi.tambah')->middleware('auth');
Route::post('/tambah-transaksi/proses', [TransactionController::class, 'tambahTransaksiProses'])->name('transaksi.tambah.proses')->middleware('auth');

Route::get('/riwayat', [HistoryController::class, 'index'])->name('riwayat')->middleware('auth');
Route::get('/riwayat-expoort', [HistoryController::class, 'export'])->name('riwayat.export')->middleware('auth');
