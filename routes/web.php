<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home.index');
});

Route::prefix('panel')->group(
    function () {
        Route::get('/login', [LoginController::class, 'index'])->name('login');
        Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    }
);



Route::middleware(['auth'])->group(
    function () {
        Route::prefix('dashboard')->middleware(['role:author'])->group(function () {
            Route::get('/', function () {
                return view('admin.dashboard.index');
            })->name('author.dashboard');
        });
    }
);
