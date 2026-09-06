<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoorWay\Client\ProfileUpgradeController;

Route::prefix('access')->middleware(['auth:sanctum', 'access:client'])->group(function () {
    Route::post('profile-upgrade', [ProfileUpgradeController::class, 'upgrade']);
});