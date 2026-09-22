<?php

use App\Http\Controllers\Kyc\VerifyByBVNController;
use App\Http\Controllers\Kyc\VerifyByDocumentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('kyc')->middleware('auth:sanctum')->group(function () {
    Route::post('by-bvn', [VerifyByBVNController::class, '__invoke']);
    Route::post('by-document', [VerifyByDocumentController::class, '__invoke']);
});