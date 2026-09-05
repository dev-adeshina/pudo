<?php 

use App\Http\Controllers\DoorWay\EmailVerificationController;
use App\Http\Controllers\DoorWay\Profile\GeneralProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::middleware('auth:sanctum')->group(function () {
    Route::post('personal-profile', GeneralProfileController::class);
    Route::get('/email/verify', [EmailVerificationController::class, 'show'])->name('verification.notice');
    Route::get('/email/verification-notification', [EmailVerificationController::class, 'resend'])->middleware(['throttle:6,1'])->name('verification.send');
});