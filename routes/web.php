<?php

use App\Http\Controllers\Booking\CancelSlotBookingController;
use App\Http\Controllers\Booking\CreateSlotBookingController;
use App\Http\Controllers\Booking\ListAvalibleBusinessController;
use App\Http\Controllers\Booking\ShowBusinessSlotsController;
use App\Http\Controllers\Booking\UserBookingsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

route::group(['middleware' => ['auth', 'verified']], function () {
    route::get('/business', ListAvalibleBusinessController::class)->name('business.list');
    route::get('/slots/{business}/{year}/{month}/{day}', ShowBusinessSlotsController::class)->name('slots.show');
    route::post('/slots/{business}/{slot}/book', CreateSlotBookingController::class)->name('slots.book');
    route::post('/slots/{business}/{booking}/cancel', CancelSlotBookingController::class)->name('bookings.cancel');
    Route::get('/my-bookings', UserBookingsController::class)->name('user.bookings');
});

require __DIR__ . '/auth.php';
