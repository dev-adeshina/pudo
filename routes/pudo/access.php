<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoorWay\Vendor\ProfileUpgradeController;

Route::prefix('access/vendor')->middleware(['auth:sanctum', 'access:pudo'])->group(function () {
    Route::post('profile-upgrade', [ProfileUpgradeController::class, 'upgrade']);
});