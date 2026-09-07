<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoorWay\Vendor\ProfileUpgradeController as Vendor;
use App\Http\Controllers\DoorWay\Errand\ProfileUpgradeController as Errand;

Route::prefix('access/vendor')->middleware(['auth:sanctum', 'access:pudo'])->group(function () {
    Route::post('profile-upgrade', [Vendor::class, 'upgrade']);
});

Route::prefix('access/errand')->middleware(['auth:sanctum', 'access:pudo'])->group(function () {
    Route::post('profile-upgrade', [Errand::class, 'upgrade']);
});