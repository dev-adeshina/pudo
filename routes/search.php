<?php

use App\Http\Controllers\Search\PriceController;
use Illuminate\Support\Facades\Route;

Route::prefix('search')->group(function (){
    Route::get('/market-price/{item}/{location}', [PriceController::class, 'marketLocationPrice']);
    Route::get('/general-price/{item}', [PriceController::class, 'generalMarketPrice']);

    Route::get('item', [PriceController::class, 'SearchQuery']);
});


