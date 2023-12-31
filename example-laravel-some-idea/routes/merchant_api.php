<?php

use App\Http\Controllers\ApiMerchant\MerchantController;
use App\Http\Controllers\ApiMerchant\MerchantUserController;
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

Route::post('register', [MerchantUserController::class, 'register']);
Route::post('login', [MerchantUserController::class, 'login']);

Route::prefix('merchant')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [MerchantController::class, 'index']);
    Route::post('/', [MerchantController::class, 'store']);
    Route::post('/{id}', [MerchantController::class, 'update']);
    Route::get('/{id}', [MerchantController::class, 'show']);
});
