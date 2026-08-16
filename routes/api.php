<?php

use App\Http\Controllers\DoorWay\EmailVerificationController;
use App\Http\Controllers\DoorWay\Profile\GeneralProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('login', [\App\Http\Controllers\DoorWay\LoginController::class, 'authenticate']);
Route::post('logout', [\App\Http\Controllers\DoorWay\LogoutController::class, 'logout']);
Route::get('/email/verify', [EmailVerificationController::class, 'show'])->middleware('auth:sanctum')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware('signed')->name('verification.verify');
Route::get('/email/verification-notification', [EmailVerificationController::class, 'resend'])->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('profile', GeneralProfileController::class);
});
require __DIR__ . '/admin.php';
require __DIR__ . '/pudo.php';
require __DIR__ . '/user.php';
require __DIR__ . '/errand.php';
require __DIR__ . '/delivery.php';
require __DIR__ . '/search.php';