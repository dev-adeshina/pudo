<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoorWay\Admin\ProfileUpgradeController;

Route::prefix('access')->middleware(['auth:sanctum', 'access:admin'])->group(function () {
    Route::post('profile-upgrade', [ProfileUpgradeController::class, 'upgrade']);
});