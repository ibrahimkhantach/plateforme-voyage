<?php

use App\Http\Controllers\AventureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified',"isAdmin"])->group(function(){
        Route::get("/dashboard",[AventureController::class, 'dashboard'])->name("dashboard");
        Route::get("/users",[UserController::class, 'index'])->name("users");
        Route::delete("/user/{id}",[UserController::class, 'destroy'])->name("user.destroy");

}) ;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/aventure/pdf', [AventureController::class, 'downloadPdf'])
    ->name('aventure.pdf');
    Route::resource("aventure",AventureController::class );
    Route::get('/', [AventureController::class, 'index'])->name('home');
    Route::get('/search', [AventureController::class, 'search'])->name( 'aventure.search');
    
});

require __DIR__.'/auth.php';

