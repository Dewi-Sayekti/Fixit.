<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AduanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'signup'])->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD & VIEW
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'jelajah'])
        ->name('dashboard');

    Route::get('/dashboard/zona/{id}', [DashboardController::class, 'zonaDetail'])
        ->name('dashboard.zona');

    // ✅ SATU-SATUNYA ROUTE VIEW ADUAN
    Route::get('/aduan', [AduanController::class, 'aduanList'])
    ->middleware('auth')    
    ->name('aduan.index');

    Route::get('/profil', function () {
        return view('profil');
    })->name('profil');
});

/*
|--------------------------------------------------------------------------
| ADUAN ACTION (NO VIEW HERE)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/aduan', [AduanController::class, 'index'])
    ->name('aduan.index');

    Route::post('/aduan/store', [AduanController::class, 'store'])
        ->name('aduan.store');

    Route::post('/aduan/{id}/rating', [AduanController::class, 'rating'])
        ->name('aduan.rating');

    Route::post('/aduan/{id}/proses', [AduanController::class, 'proses'])
        ->name('aduan.proses');

    Route::post('/aduan/{id}/selesai', [AduanController::class, 'selesai'])
        ->name('aduan.selesai');
});
