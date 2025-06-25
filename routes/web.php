<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;

// 🔐 Ép login khi vào "/"
Route::get('/', function () {
    return redirect('/dashboard'); // chuyển hướng về dashboard
});

// 🔐 Dashboard yêu cầu đăng nhập
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 🔐 Các route yêu cầu login
Route::middleware(['auth'])->group(function () {
    // Quản lý sách
    Route::resource('books', BookController::class);

    // Quản lý đơn hàng (chỉ 4 action)
    Route::resource('orders', OrderController::class)->only(['index','create','store','show']);

    // Quản lý profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🧩 Các route đăng nhập / đăng ký của Breeze
require __DIR__.'/auth.php';
