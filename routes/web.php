<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DecodeController;
use App\Http\Controllers\RoleController;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AirlineController;
use App\Http\Controllers\AirportsController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\StatesController;
use App\Http\Controllers\ServicesCodesController;

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



Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Roles
Route::middleware(['can:read roles'])->group(function (){
    Route::get('/roles/index', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/show/{role}', [RoleController::class, 'show'])->name('roles.show');
});
Route::middleware(['can:create roles'])->group(function (){
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
});
Route::middleware(['can:edit roles'])->group(function (){
    Route::get('/roles/edit/{role}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/update/{role}', [RoleController::class, 'update'])->name('roles.update');
});
Route::delete('/roles/delete/{role}', [RoleController::class, 'destroy'])->name('roles.delete')
    ->middleware('can:delete roles');

//Permissions
Route::middleware(['can:read permissions'])->group(function (){
    Route::get('/perms/index', [PermissionController::class, 'index'])->name('perms.index');
    Route::get('/perms/show/{permission}', [PermissionController::class, 'show'])->name('perms.show');
});
Route::middleware(['can:create permissions'])->group(function (){
    Route::get('/perms/create', [PermissionController::class, 'create'])->name('perms.create');
    Route::post('/perms', [PermissionController::class, 'store'])->name('perms.store');
});
Route::middleware(['can:edit permissions'])->group(function (){
    Route::get('/perms/edit/{permission}', [PermissionController::class, 'edit'])->name('perms.edit');
    Route::put('/perms/update/{permission}', [PermissionController::class, 'update'])->name('perms.update');
});
Route::delete('/perms/delete/{permission}', [PermissionController::class, 'destroy'])->name('perms.delete')
    ->middleware('can:delete permissions');

//RECORDS
Route::middleware(['can:read records'])->group(function () {
    Route::get('/airlines/index', [AirlineController::class, 'index'])->name('airlines.index');
    Route::get('/airports/index', [AirportsController::class, 'index'])->name('airports.index');
    Route::get('/countries/index', [CountriesController::class, 'index'])->name('countries.index');
    Route::get('/states/index', [StatesController::class, 'index'])->name('states.index');
    Route::get('/services/index', [ServicesCodesController::class, 'index'])->name('services.index');
});



Route::get('/', [DecodeController::class, 'index'])->name('index.decoder');
Route::post('/home', [DecodeController::class, 'decoder'])->name('decode.decoder');
