<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\SessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//route resource
Route::get('/User', [\App\Http\Controllers\UserController::class, 'index']);
Route::resource('/siswa', SiswaController::class);
Route::resource('/pembayaran', PembayaranController::class);

Route::get('/pembayaran/{siswa_id}/history', [PembayaranController::class, 'history'])->name('pembayaran.history');

Route::get('/sesi',[SessionController::class, 'index']);
Route::get('/sesi/logout',[SessionController::class, 'logout']);
Route::get('/login',[SessionController::class, 'viewlogin']);
Route::post('/sesi/login',[SessionController::class, 'login']);
Route::get('/sesi/register',[SessionController::class, 'register']);
Route::post('/sesi/create',[SessionController::class, 'create']);
