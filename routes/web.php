<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/', 'middleware' => 'user-auth'], function () {
    // Admin
    Route::controller(AdminController::class)->group(function(){
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/settings', 'list_setting')->name('settings.index');
    Route::patch('/settings/{setting}', 'update_setting')->name('settings.update');
    });
    // profile & profile
    Route::controller(UserController::class)->group(function(){
        Route::get('/profile_', 'profile')->name('profile_');
        Route::post('/logout_', 'logout')->name('logout_');
        Route::get('/users', 'index')->name('users.index');
        Route::post('/users', 'store')->name('users.store');
        Route::delete('/users/{user}', 'destroy')->name('users.delete');
        Route::get('/users/{user}/edit', 'edit')->name('users.edit');
        Route::patch('/myprofile_/{user}', 'updateProfile')->name('profile.update');
    });

    // category post
    Route::controller(PostController::class)->group(function(){
        Route::get('/categories',  'categories')->name('categories.index');
        Route::post('/categories',  'save_category')->name('categories.store');
        Route::delete('/categories/{category}',  'delete_category')->name('categories.delete');
    });
    Route::resource('/posts',PostController::class)->except(['edit']);

});
Route::get('/', [UserController::class, 'login'])->name('login');
Route::post('/', [UserController::class, 'login_check'])->name('login-check');
