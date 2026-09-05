<?php

use App\Http\Controllers\DoorWay\EmailVerificationController;
use App\Http\Controllers\DoorWay\Profile\GeneralProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('login', [\App\Http\Controllers\DoorWay\LoginController::class, 'authenticate']);
Route::post('logout', [\App\Http\Controllers\DoorWay\LogoutController::class, 'logout']);

require __DIR__ . '/admin.php';
require __DIR__ . '/pudo.php';
require __DIR__ . '/user.php';
require __DIR__ . '/errand.php';
require __DIR__ . '/delivery.php';
require __DIR__ . '/search.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/signed.php';