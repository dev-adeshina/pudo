<?php

use App\Http\Controllers\Wallet\OnboardCustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('wallet')->middleware(['auth:sanctum', 'kyc:1'])->group(function () {
    Route::post('onboard-user', [OnboardCustomerController::class, 'onboardCustomer']);
});