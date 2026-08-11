<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('login', [\App\Http\Controllers\DoorWay\LoginController::class, 'authenticate']);
Route::post('logout', [\App\Http\Controllers\DoorWay\LogoutController::class, 'logout']);

require __DIR__ . '/admin.php';
require __DIR__ . '/pudo.php';
require __DIR__ . '/user.php';