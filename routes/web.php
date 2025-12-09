<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\PenginapanController;
use App\Http\Controllers\ProfileController;
use App\Models\Dummy;
use Illuminate\Support\Arr;
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

require __DIR__.'/auth.php';

Route::get('/', [PenginapanController::class, 'index'])->name('xdashboard');

Route::get('/form/penginapan', [PenginapanController::class, 'create'])->name('listings.create');

Route::get('/penginapan/{listings}/edit', [PenginapanController::class, 'edit'])->name('listings.edit');
Route::post('/penginapan', [PenginapanController::class, 'store'])->name('listings.store')->middleware('auth');
Route::post('/penginapan/favorite/{id}', [PenginapanController::class, 'favorite'])->name('listings.favorite')->middleware('auth');
Route::post('/penginapan/favorite/{id}/cancel', [PenginapanController::class, 'cancelFavorite'])->name('listings.xfavorite')->middleware('auth');

Route::patch('/penginapan/{id}', [PenginapanController::class, 'update'])->name('listings.update')->middleware('auth');
Route::delete('/penginapan/{id}/delete', [PenginapanController::class, 'destroy'])->name('listings.destroy')->middleware('auth');

Route::get('/penginapan/{id}', [PenginapanController::class, 'show'])->name('listings.show');

Route::get('/favorite', [MenuController::class, 'favorite'])->name('menu.favorite')->middleware('auth');
Route::get('/penginapan-anda', [MenuController::class, 'penginapan'])->name('menu.penginapan')->middleware('auth');