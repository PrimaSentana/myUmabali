<?php

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
Route::patch('/penginapan/{id}', [PenginapanController::class, 'update'])->name('listings.update')->middleware('auth');

Route::post('/penginapan', [PenginapanController::class, 'store'])->middleware('auth');

Route::get('/penginapan/{id}', [PenginapanController::class, 'show'])->name('listings.show');