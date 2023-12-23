<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/', 'middleware' => 'user-auth'], function () {
    // Admin
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });
    // profile & profile
    Route::controller(UserController::class)->group(function () {
        Route::get('/profile_', 'profile')->name('profile_');
        Route::post('/logout_', 'logout')->name('logout_');
        Route::get('/users', 'index')->name('users.index');
        Route::post('/users', 'store')->name('users.store');
        Route::delete('/users/{user}', 'destroy')->name('users.delete');
        Route::get('/users/{user}/edit', 'edit')->name('users.edit');
        Route::patch('/users/{user}', 'update')->name('users.update');
        Route::patch('/myprofile_/{user}', 'updateProfile')->name('profile.update');
    });

    // pasien dokter ruangan jadwal
    Route::resource('/pasien', PasienController::class)->except(['create','show']);
    Route::resource('/dokter', DokterController::class)->except(['create','show']);
    Route::resource('/ruangan', RuangController::class)->except(['create','show']);
    Route::resource('/jadwal', JadwalController::class)->except(['create']);
    Route::get('/downloadpdf', [AdminController::class,'downloadPdf'])->name('jadwal.pdf');
    Route::get('/detail/{jadwal}', [AdminController::class,'detail'])->name('jadwal.detail');

});
Route::get('/', [UserController::class, 'login'])->name('login');
Route::post('/', [UserController::class, 'login_check'])->name('login-check');
