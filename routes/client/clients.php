<?php


use App\Http\Controllers\DoorWay\Client\ProfileUpgradeController;
use App\Http\Controllers\Vride\BookController;
use Illuminate\Support\Facades\Route;

Route::prefix('client')->middleware(['auth:sanctum'])->group(function () {
    Route::post('book-trip', [BookController::class, 'bookTrip']);
});