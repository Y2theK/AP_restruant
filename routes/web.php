<?php

// use livewire;
use App\Http\Livewire\UserLists;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DishesController;

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

// --------------Kitchen Panel -------------------//
//shoud rename DishController to KitchenController
Route::resource('/dish', App\Http\Controllers\DishesController::class);
Route::get('/order', [App\Http\Controllers\DishesController::class, 'order'])->name('kitchen.order');
Route::get('/order/{order}/approve', [App\Http\Controllers\DishesController::class, 'approve'])->name('kitchen.order.approve');
Route::get('/order/{order}/cancel', [App\Http\Controllers\DishesController::class, 'cancel'])->name('kitchen.order.cancel');
Route::get('/order/{order}/ready', [App\Http\Controllers\DishesController::class, 'ready'])->name('kitchen.order.ready');

// --------------Waiter Panel -------------------//
Route::get('/', [OrderController::class,'index'])->name('order.form');
Route::post('order_submit', [OrderController::class,'submit'])->name('order.submit');
Route::get('/order/{order}/serve', [App\Http\Controllers\OrderController::class, 'serve'])->name('order.serve');
Route::get('/order/{order}/notify', [App\Http\Controllers\OrderController::class, 'notifyCancel'])->name('order.notify_cancel');

//will do this later
// category module crud and users modules crud
Route::resource('/category', App\Http\Controllers\DishesController::class);
Route::resource('/users', App\Http\Controllers\DishesController::class);

//-------------- to do list ------------------------------//
//naming routes uses
//ui improve
//unit testing
//finding and fixing bugs
