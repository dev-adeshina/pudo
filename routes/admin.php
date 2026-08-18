<?php

use App\Http\Controllers\DoorWay\Admin\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function () {
    Route::post('/register', [RegisterController::class, 'register'])->defaults('access_point_id', 1);



    require __DIR__ . '/admin/activities.php';
});