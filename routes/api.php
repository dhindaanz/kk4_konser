<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdminn;
use App\Http\Middleware\CheckUser;
use App\Http\Controllers\KonserController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\UserController;

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

Route::post('/user/register',[UserController::class, 'register']);
Route::post('/user/login',[UserController::class, 'login']);


Route::middleware('auth:sanctum')->group(function() {
    Route::post('/user/logout', [UserController::class, 'logout']);
    Route::get('/konser', [KonserController::class, 'index']);
    Route::get('/konser/{id}',[KonserController::class, 'show']);
    Route::get('/transaksi',[TransaksiController::class, 'index']);
    Route::get('/transaksi/{id_transaksi}', [TransaksiController::class, 'show']);
    Route::get('/verifikasi/{id_verifikasi}', [VerifikasiController::class, 'show']);


    Route::middleware([CheckAdminn::class])->group(function() {
        Route::post('/konser', [KonserController::class, 'store']);
        Route::put('/konser/{id}', [KonserController::class, 'update']);
        Route::delete('/konser/{id}', [KonserController::class, 'destroy']);
        Route::put('/transaksi/konf/{id_transaksi}',[TransaksiController::class, 'konfirmasiBayar']);
        Route::post('/verifikasi', [VerifikasiController::class, 'store']);
    });

    Route::middleware([CheckUser::class])->group(function() {
        Route::post('/transaksi', [TransaksiController::class, 'store']);
        Route::put('/transaksi/bayar/{id_transaksi}', [TransaksiController::class, 'bayar']);
    });
});