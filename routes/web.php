<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DecodeController;
use App\Http\Controllers\RoleController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Route::get('/roles/index', [RoleController::class, 'index'])->name('roles.index');
Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create')->middleware('can:show roles');

Route::get('/decode/index', [DecodeController::class, 'index'])->name('decode.index');
Route::post('/decode/show', [DecodeController::class, 'decoder'])->name('decode.decoder');
