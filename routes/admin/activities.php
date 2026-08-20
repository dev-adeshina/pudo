<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Activity\BrandController;
use App\Http\Controllers\Admin\Activity\CategoryController;
use App\Http\Controllers\Admin\Activity\LogisticsProfileController;
use App\Http\Controllers\Admin\Activity\SizeClassController;
use App\Http\Controllers\Admin\Activity\WeightClassController;



Route::prefix('activities')->middleware(['auth:sanctum', 'access:admin'])->group(function () {
    Route::get('get-category', [CategoryController::class, 'show']);
    Route::get('get-brand', [BrandController::class, 'show']);
    Route::get('get-logisticprofile', [LogisticsProfileController::class, 'show']);
    Route::get('get-sizeclass', [SizeClassController::class, 'show']);
    Route::get('get-weightclass', [WeightClassController::class, 'show']);

    Route::post('create-category', [CategoryController::class, 'store']);
    Route::post('create-brand', [BrandController::class, 'store']);
    Route::post('create-logisticprofile', [LogisticsProfileController::class, 'store']);
    Route::post('create-sizeclass', [SizeClassController::class, 'store']);
    Route::post('create-weightclass', [WeightClassController::class, 'store']);
    // Route::post('');
});