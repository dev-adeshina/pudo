<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoorWay\User\RegisterController;
use App\Http\Controllers\Vride\BookController;

Route::prefix('client')->group(function () {
    Route::post('/register', [RegisterController::class, 'register'])->defaults('access_point_id', 2);
    // Route::post('/book-trip', [BookController::class, 'register']);
    require __DIR__ . '/client/clients.php';
    require __DIR__ . '/client/access.php';
});