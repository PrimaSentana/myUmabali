<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PenginapanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Models\Dummy;
use App\Models\Reservation;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

use function Livewire\store;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', [PenginapanController::class, 'index'])->name('xdashboard');

// Listings
Route::get('/form/penginapan', [PenginapanController::class, 'create'])->name('listings.create');
Route::get('/penginapan/{listings}/edit', [PenginapanController::class, 'edit'])->name('listings.edit');
Route::post('/penginapan', [PenginapanController::class, 'store'])->name('listings.store')->middleware('auth');
Route::post('/penginapan/favorite/{id}', [PenginapanController::class, 'favorite'])->name('listings.favorite')->middleware('auth');
Route::post('/penginapan/favorite/{id}/cancel', [PenginapanController::class, 'cancelFavorite'])->name('listings.xfavorite')->middleware('auth');
Route::patch('/penginapan/{id}', [PenginapanController::class, 'update'])->name('listings.update')->middleware('auth');
Route::delete('/penginapan/{id}/delete', [PenginapanController::class, 'destroy'])->name('listings.destroy')->middleware('auth');
Route::get('/penginapan/{id}', [PenginapanController::class, 'show'])->name('listings.show');

// Menu
Route::get('/favorite', [MenuController::class, 'favorite'])->name('menu.favorite')->middleware('auth');
Route::get('/owner/penginapan', [MenuController::class, 'penginapan'])->name('menu.penginapan')->middleware('auth');

// Reservasi
Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation.my')->middleware('auth');
Route::get('/checkout/{id}', [ReservationController::class, 'checkout'])->name('reservation.checkout')->middleware('auth');
Route::post('/reservation/{id}', [ReservationController::class, 'store'])->name('reservation.store')->middleware('auth');
Route::patch('/reservation/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservation.cancel')->middleware('auth');

//Booking
Route::get('/owner/booking', [OwnerController::class, 'index'])->name('booking.my')->middleware('auth');
Route::get('/owner/booking/{reservation}', [OwnerController::class, 'show'])->name('booking.show')->middleware('auth');

// review
Route::get('/reservation/{id}/review', [ReviewController::class, 'create'])->name('review.create')->middleware('auth');
Route::post('/reservation/{id}/review', [ReviewController::class, 'store'])->name('review.store')->middleware('auth');

// testing doang ngab
Route::get('/testing', function() {
    return view('testing');
});