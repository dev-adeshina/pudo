<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoorWay\Pudo\RegisterController;


Route::prefix('pudo')->group(function () {
    Route::post('/register', [RegisterController::class, 'register'])->defaults('access_point_id', 3);
   require __DIR__ . "/pudo/vendor.php";
});

