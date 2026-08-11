<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoorWay\User\RegisterController;

Route::prefix('user')->group(function () {
    Route::post('/register', [RegisterController::class, 'register'])->defaults('access_point_id', 2);
});