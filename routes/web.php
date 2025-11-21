<?php

use App\Http\Controllers\AventureController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard',  [AventureController::class, 'dashboard'])
->middleware(['auth', 'verified',"isAdmin"])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource("aventure",AventureController::class );
    Route::get('/', [AventureController::class, 'index'])->name('home');
    Route::get('/search', [AventureController::class, 'search'])->name( 'aventure.search');
});

require __DIR__.'/auth.php';

