<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DecodeController;

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


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::post('/login', [AuthController::class, 'login']);

Route::post('/decoder', [DecodeController::class, 'unauth_decoder'])->name('decoder.api');


Route::post('/auth_decoder', [DecodeController::class, 'auth_decoder'])
    ->name('auth_decoder.api')
    ->middleware('auth:sanctum');
