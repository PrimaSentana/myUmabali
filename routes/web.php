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

Route::get('/penginapan/{id}', [PenginapanController::class, 'show']);
Route::get('/form/penginapan', [PenginapanController::class, 'create']);
Route::post('/penginapan', [PenginapanController::class, 'store'])->middleware('auth');