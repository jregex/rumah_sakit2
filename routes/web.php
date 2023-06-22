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
    Route::resource('/posts',PostController::class)->except(['edit']);

    // pegawai jabatan
    Route::get('/jabatans', [PegawaiController::class, 'jabatan_list'])->name('jabatan.index');
    Route::post('/jabatans', [PegawaiController::class, 'jabatan_save'])->name('jabatan.store');
    Route::patch('/jabatans', [PegawaiController::class, 'jabatan_update'])->name('jabatan.update');
    Route::delete('/jabatans/{jabatan}', [PegawaiController::class, 'jabatan_delete'])->name('jabatan.delete');
    Route::get('/pegawais', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::delete('/pegawais/{pegawai}',[PegawaiController::class,'destroy'])->name('pegawai.delete');
    Route::post('/pegawais',[PegawaiController::class,'store'])->name('pegawai.store');
    Route::get('/pegawais/{id}',[PegawaiController::class,'show'])->name('pegawai.details');
    Route::patch('/pegawais/{pegawai}',[PegawaiController::class,'update'])->name('pegawai.update');

    // aturan jenis aturan
    Route::get('/jenis-aturan',[AdminController::class,'jenis_aturan'])->name('jenis.index');
    Route::post('/jenis-aturan',[AdminController::class,'tambah_jenis'])->name('jenis.store');
    Route::patch('/jenis-aturan',[AdminController::class,'update_jenis'])->name('jenis.update');
    Route::delete('/jenis-aturan/{categoryAturan}',[AdminController::class,'delete_jenis'])->name('jenis.delete');
    Route::get('/aturan',[AdminController::class,'list_aturan'])->name('aturan.index');
    Route::post('/aturan',[AdminController::class,'tambah_aturan'])->name('aturan.store');
    Route::delete('/aturan/{aturan}',[AdminController::class,'delete_aturan'])->name('aturan.delete');
    Route::get('/aturan/{aturan}/edit',[AdminController::class,'edit_aturan'])->name('aturan.edit');
    Route::patch('/aturan/{aturan}',[AdminController::class,'update_aturan'])->name('aturan.update');
    Route::get('/aturan-download/{aturan}',[AdminController::class,'download_aturan'])->name('aturan.download');
});
Route::get('/', [UserController::class, 'login'])->name('login');
Route::post('/', [UserController::class, 'login_check'])->name('login-check');
