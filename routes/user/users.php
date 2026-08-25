<?php

use App\Http\Controllers\Vride\BookController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->middleware(['auth:sanctum', 'access:user'])->group(function () {
    Route::post('book-trip', [BookController::class, 'bookTrip']);
});