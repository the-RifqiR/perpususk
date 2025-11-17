<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RequestPeminjamanController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BookController::class, 'public'])->name('books.public');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Membuat pengecekan role untuk membuka/melakukan aksi, check role petugas
Route::middleware('auth', 'role:petugas')->group(function () {
    Route::resource('books/petugas', BookController::class)->except('destroy')->parameters(['petugas' => 'book']);;
    Route::delete('/books/petugas/{book}', [BookController::class, 'destroy'])->name('petugas.destroy');

    Route::resource('kategori', KategoriController::class);
    Route::resource('users', UserController::class);

    Route::get('/requests', [RequestPeminjamanController::class, 'index'])->name('requests.index');
    Route::put('/requests/{req}/status', [RequestPeminjamanController::class, 'updateStatus'])->name('requests.updateStatus');

    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::put('/transactions/{transaction}/return', [TransactionController::class, 'updateStatus'])->name('transactions.return');
});

Route::middleware('auth', 'role:pengunjung')->group(function () {
    Route::get('/requests/create/{book}', [RequestPeminjamanController::class, 'create'])->name('requests.create');
    Route::post('/requests/store/{book}', [RequestPeminjamanController::class, 'store'])->name('requests.store');
    Route::get('/books', [BookController::class, 'pengunjungDashboard'])->name('books.list');
});
