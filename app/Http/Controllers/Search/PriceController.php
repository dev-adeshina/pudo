<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Http\Requests\Search\PriceRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Responses\ApiResponse;

class PriceController extends Controller
{
    //

    public function marketLocationPrice(PriceRequest $request): JsonResponse
    {
        
        $item = $request->item;
        $location = $request->location;
        $min_amount = "500";
        $available = true;
        return ApiResponse::success([
            'item' => $item,
            'location' => $location,
            'amount' => $min_amount,
            'available' => $available,
        ]);
    }

    public function generalMarketPrice(PriceRequest $request): JsonResponse 
    {

        $item = $request->item;
        $location = $request->location;
        $min_amount = "500";
        $available = true;


        return ApiResponse::success([
            'location' => [
                'local' => [
                    'item' => $item,
                    'location' => 'enugu',
                    'amount' => $min_amount,
                    'available' => $available,
                ],
                'local_2' => [
                    'item' => $item,
                    'location' => 'ibadan',
                    'amount' => $min_amount,
                    'available' => $available,
                ],
                'local_3' => [
                    'item' => $item,
                    'location' => 'oyo',
                    'amount' => $min_amount,
                    'available' => $available,
                ],
                'local_4' => [
                    'item' => $item,
                    'location' => 'lagos',
                    'amount' => $min_amount,
                    'available' => $available,
                ],
                'local_5' => [
                    'item' => $item,
                    'location' => 'jos',
                    'amount' => $min_amount,
                    'available' => $available,
                ],
            ]
        ]);
    }
}
