<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemInfoController;
use App\Http\Controllers\SubProductController;
use App\Http\Controllers\HealthUnitOrderController;


Route::get('/', function () { return view('welcome'); });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('products', ProductController::class);

Route::resource('subproducts', SubProductController::class);

// CRUD كامل للمنتجات الرئيسية
Route::resource('items', ItemController::class);

// CRUD كامل لمعلومات المنتجات (العدد والصلاحية)
Route::resource('iteminfos', ItemInfoController::class);

Route::resource('healthUnitOrders', HealthUnitOrderController::class);

Route::post('orders/{order}/send', [OrderController::class, 'sendOrder'])->name('orders.send');

Route::put('health-unit-orders/{id}/status', [HealthUnitOrderController::class, 'updateStatus'])->name('healthUnitOrders.updateStatus');

Route::get('health-unit-orders/stats', [HealthUnitOrderController::class, 'warehouseStats'])->name('healthUnitOrders.stats');


Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::put('/users/{user}/change-role', [UserController::class, 'changeRole'])->name('users.changeRole');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

Route::middleware(['auth'])->group(function () {
    Route::resource('orders', OrderController::class);
});


