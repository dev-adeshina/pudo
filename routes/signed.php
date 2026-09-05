<?php 

use App\Http\Controllers\DoorWay\EmailVerificationController;
use App\Http\Controllers\DoorWay\Profile\GeneralProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware('signed')->name('verification.verify');