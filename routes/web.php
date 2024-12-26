<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->name('home');
Route::get('/{slug}',[CategoryController::class,'view'])->name('category.view');
Route::get('/{category:slug}/{place:slug}',[BookingController::class,'view'])->name('booking.view');
Route::post('/booking-create',[BookingController::class,'store'])->name('booking.create');