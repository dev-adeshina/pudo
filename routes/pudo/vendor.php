<?php

use App\Http\Controllers\Vendor\ListController;
use App\Http\Controllers\Vendor\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('vendor')->middleware('auth:sanctum')->group(function () {
    Route::get('business-listing', [ListController::class, 'show']);
    Route::post('business-listing', [ListController::class, 'store']);
    Route::get('location-listing', [LocationController::class, 'show']);
    Route::post('location-listing', [LocationController::class, 'store']);
});
