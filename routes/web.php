<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('workshops', WorkshopController::class);

Route::post('/workshops/{workshop}/bookings', [BookingController::class, 'store'])
    ->name('bookings.store');

Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])
    ->name('bookings.destroy');
