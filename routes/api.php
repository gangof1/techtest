<?php

use App\Http\Controllers\Order\OrderDeleteController;
use App\Http\Controllers\Order\OrderIndexController;
use App\Http\Controllers\Order\OrderShowController;
use App\Http\Controllers\Order\OrderStoreController;
use App\Http\Controllers\Order\OrderUpdateController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\OrderNotFoundMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/

Route::get('/orders', [OrderIndexController::class, 'index'])->name('orders.index');
Route::get('/orders/{order}', [OrderShowController::class, 'show'])->name('orders.show');
Route::post('/orders', [OrderStoreController::class, 'store'])->name('orders.store');
Route::patch('/orders/{order}', [OrderUpdateController::class, 'update'])->name('orders.update');
Route::delete('/orders/{order}', [OrderDeleteController::class, 'destroy']);
