<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::group(['prefix' => 'admin:2000', 'middleware' => 'user-auth'], function () {
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
});
Route::get('/admin:2000', [UserController::class, 'login'])->name('login');
Route::post('/admin:2000', [UserController::class, 'login_check'])->name('login-check');
