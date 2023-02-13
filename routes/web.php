<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

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


Route::controller();

Route::group(['prefix' => '/'], function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/login', [LoginController::class, 'create'])->middleware('guest');
    Route::post('/login', [LoginController::class, 'store']);
    Route::post('/logout', [LoginController::class, 'destroy']);
});

Route::group(['prefix' => '/products', 'middleware' => 'role'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductController::class, 'create']);
    Route::post('/store', [ProductController::class, 'store']);
    Route::get('/{id}/edit', [ProductController::class, 'edit']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');


Route::group(['prefix' => '/admin', 'middleware' => 'role'], function () {
    Route::get('/users', [AdminController::class, 'index']);
    Route::get('/users/create', [AdminController::class, 'create']);
    Route::post('/users/store', [AdminController::class, 'store']);
    Route::get('/users/{id}/edit', [AdminController::class, 'edit']);
    Route::put('/users/{id}', [AdminController::class, 'update']);
    Route::delete('/users/{id}', [AdminController::class, 'destroy']);
    Route::resource('/roles', RoleController::class);
    Route::post('/roles/{role}/permissions',
        [RoleController::class,  'givePermission'])->name('roles.permissions');;
    Route::delete('/roles/{role}/permissions/{permission}',
        [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
    Route::resource('/permissions', PermissionController::class);
});





