<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

// Public Routes
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// User Order Route
Route::middleware(['auth'])->group(function () {
    Route::post('/order', [App\Http\Controllers\OrderController::class, 'store'])->name('order.store');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [TransaksiController::class, 'index'])->name('dashboard');
    
    // Transaksi
    Route::post('/transaksi/tambah', [TransaksiController::class, 'tambah']);
    Route::get('/update-status/{id}', [TransaksiController::class, 'updateStatus']);
    Route::get('/hapus/{id}', [TransaksiController::class, 'hapus']);
    
    // Pembayaran
    Route::get('/pembayaran/{id}', [PembayaranController::class, 'show']);
    Route::post('/pembayaran', [PembayaranController::class, 'store']);
    Route::get('/nota/{id}', [PembayaranController::class, 'nota']);

    // Produk
    Route::resource('products', ProductController::class);
});