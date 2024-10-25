<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

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


Route::middleware(['auth'])->group(function () {
    Route::resource('orders', OrderController::class);
    Route::resource('users', UserController::class);
});

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/', [OrderController::class, 'index'])->name('orders.index');