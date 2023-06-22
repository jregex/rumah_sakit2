<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/pegawai-api',[App\Http\Controllers\PegawaiController::class,'pegawai_api']);
Route::get('/api-edit-jabatan/{id}',[App\Http\Controllers\PegawaiController::class,'editJabatan']);
Route::get('/api-edit-jenis/{id}',[App\Http\Controllers\AdminController::class,'editJenis']);

// post
Route::get('/posts',[App\Http\Controllers\Api\ApiController::class,'list_post']);
