<?php


use App\Http\Controllers\General\AccountController;
use App\Http\Controllers\Vride\BookController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->middleware(['auth:sanctum'])->group(function () {
    Route::post('book-trip', [BookController::class, 'bookTrip']);
    Route::get('/user', [AccountController::class, 'account']);
});