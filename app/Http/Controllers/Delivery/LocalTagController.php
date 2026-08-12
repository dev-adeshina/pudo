<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use App\Http\Requests\Delievery\LocalTagRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redis;



class LocalTagController extends Controller
{
    //

    public function tagging(LocalTagRequest $request): JsonResponse
    {
        $driver = $request->user();
        Redis::geoadd(
            'drivers',
            $request->longitude,
            $request->latitude,
            $driver->id
        );

       Redis::setex("driver:$driver->id:online", 15, '1');
       Redis::sadd('drivers:available', $driver->id);

       return ApiResponse::success([
            'message' => 'Driver tagged successfully',
        ]);
    }


}
