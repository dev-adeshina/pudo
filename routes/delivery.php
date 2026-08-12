<?php 

use App\Http\Controllers\Delivery\LocalTagController;
use App\Http\Controllers\Delivery\NearestRideController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('delivery')->middleware('auth:sanctum')->group(function () {
    Route::post('/tagging', [LocalTagController::class, 'tagging'])->defaults('access_point_id', 6);
    Route::post('/getRide', [NearestRideController::class, 'searchNearBy'])->defaults('access_point_id', 6);

});