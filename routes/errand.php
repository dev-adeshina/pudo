<?php

use App\Http\Controllers\DoorWay\Errand\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('errand')->group(function () {
    Route::post('/register', [RegisterController::class, 'register'])->defaults('access_point_id', 3);
});