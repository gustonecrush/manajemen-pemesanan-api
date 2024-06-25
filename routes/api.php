<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangPemesananController;
use App\Http\Controllers\InvoicePemesananController;
use App\Http\Controllers\NotaJalanController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => 'api'], function () {
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::get('me', [UserController::class, 'me']);
});

Route::apiResource('roles', RoleController::class);
Route::apiResource('nota-jalans', NotaJalanController::class);
Route::apiResource('barang-pemesanans', BarangPemesananController::class);
Route::apiResource('invoices', InvoicePemesananController::class);

Route::apiResource('barangs', BarangController::class); // edit
Route::apiResource('pemesanans', PemesananController::class); // edit
Route::post('pemesanans/{id}', [PemesananController::class, 'updatePemesanan']);
Route::post('barangs/{id}', [BarangController::class, 'updateBarang']);
