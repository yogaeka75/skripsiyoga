<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\LandingpageController;

use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\PurchaseOrderItemController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\SalesOrderItemController;
use App\Http\Controllers\HistoryController;

use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;

Route::get('/', [LandingpageController::class, 'index']);
Route::get('/product', [LandingpageController::class, 'product']);
Route::get('/product/{id}', [LandingpageController::class, 'productDetail']);

// AUTH
Route::get('/login', [AuthController::class, 'index'])
    ->name('login')
    ->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->middleware('guest');

Route::post('/logout', [AuthController::class, 'logout']);

// DASHBOARD
Route::resource('/dashboard', DashboardController::class)->middleware('auth');

Route::resource('/purchase-order', PurchaseOrderController::class)->middleware('auth');
Route::resource('/purchase-order-item', PurchaseOrderItemController::class)->middleware('auth');
Route::resource('/sales-order', SalesOrderController::class)->middleware('auth');
Route::resource('/sales-order-item', SalesOrderItemController::class)->middleware('auth');
Route::resource('/history', HistoryController::class)->middleware('auth');

Route::resource('/item', ItemController::class)->middleware('auth');
Route::resource('/user', UserController::class)->middleware('auth');
