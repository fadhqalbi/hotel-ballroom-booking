<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingSummaryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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

Route::get('/',[LoginController::class,'home']);

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'login'])->name('login.process');

Route::middleware(['auth'])->group(function(){
    Route::post('logout',[LoginController::class,'logout'])->name('logout');
    
    // Route::get('/dashboard',function(){
    //     return view('dashboards.index');
    // })->name('dashboard');

    Route::get('/booking/summary',[BookingController::class,'summary'])->name('summary');
    Route::post('/booking/summary',[BookingController::class,'getsummary'])->name('getsummary');

    Route::resource('customer',CustomerController::class);
    Route::resource('booking',BookingController::class);
    Route::resource('bookingsummary',BookingSummaryController::class);


});
