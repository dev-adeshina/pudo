<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoorWay\Vride\ProfileUpgradeController as Vride;
use App\Http\Controllers\DoorWay\Agent\ProfileUpgradeController as Agent;
use App\Http\Controllers\DoorWay\Actor\ProfileUpgradeController as Actor;
use App\Http\Controllers\DoorWay\Vendor\ProfileUpgradeController as Vendor;
use App\Http\Controllers\DoorWay\Errand\ProfileUpgradeController as Errand;


Route::prefix('access/vendor')->middleware(['auth:sanctum', 'access:pudo'])->group(function () {
    Route::post('profile-upgrade', [Vendor::class, 'upgrade']);
});

Route::prefix('access/errand')->middleware(['auth:sanctum', 'access:pudo'])->group(function () {
    Route::post('profile-upgrade', [Errand::class, 'upgrade']);
});

Route::prefix('access/vride')->middleware(['auth:sanctum', 'access:pudo'])->group(function () {
    Route::post('profile-upgrade', [Vride::class, 'upgrade']);
});

Route::prefix('access/agent')->middleware(['auth:sanctum', 'access:pudo'])->group(function () {
    Route::post('profile-upgrade', [Agent::class, 'upgrade']);
});

Route::prefix('access/actor')->middleware(['auth:sanctum', 'access:pudo'])->group(function () {
    Route::post('profile-upgrade', [Actor::class, 'upgrade']);
});