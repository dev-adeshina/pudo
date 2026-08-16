<?php

use App\Domains\Identity\Models\PudoType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoorWay\Pudo\RegisterController;


Route::prefix('pudo')->group(function () {
    Route::post('/register', [RegisterController::class, 'register'])->defaults('access_point_id', 3);
    Route::get('/type', function() {return PudoType::all();})->middleware('auth:sanctum');
   require __DIR__ . "/pudo/vendor.php";
});

