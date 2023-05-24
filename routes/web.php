<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/', 'middleware' => 'user-auth'], function () {
    // dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    // profile
    Route::get('/profile_', [UserController::class, 'profile'])->name('profile_');
    Route::post('/logout_', [UserController::class, 'logout'])->name('logout_');
    // users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.delete');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/myprofile_/{user}', [UserController::class, 'updateProfile'])->name('profile.update');

    // category post
    Route::get('/categories', [PostController::class, 'categories'])->name('categories.index');
    Route::post('/categories', [PostController::class, 'save_category'])->name('categories.store');
    Route::delete('/categories/{category}', [PostController::class, 'delete_category'])->name('categories.delete');

    // pegawai jabatan
    Route::get('/jabatans', [PegawaiController::class, 'jabatan_list'])->name('jabatan.index');
    Route::post('/jabatans', [PegawaiController::class, 'jabatan_save'])->name('jabatan.store');
    Route::delete('/jabatans/{jabatan}', [PegawaiController::class, 'jabatan_delete'])->name('jabatan.delete');
    Route::get('/pegawais', [PegawaiController::class, 'index'])->name('pegawai.index');
});
Route::get('/', [UserController::class, 'login'])->name('login');
Route::post('/', [UserController::class, 'login_check'])->name('login-check');
