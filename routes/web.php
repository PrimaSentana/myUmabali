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

Route::get('/', function () {
    $listings = Dummy::all();
    return view('xdashboard', ['listings' => $listings]);
})->name('xdashboard');

Route::get('/penginapan/{id}', function ($id) {
    $listings = Dummy::all();
    $list = Arr::first($listings, fn($list) => $list['id'] == $id);
    return view('listings', ['list' => $list]);
});

Route::get('/form/penginapan', [PenginapanController::class, 'create']);
Route::post('/penginapan', [PenginapanController::class, 'store']);