<?php

namespace App\Http\Controllers\Admin\Activity;

use App\Domains\Fulfilment\Delivery\Models\SizeClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SizeClassRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;



class SizeClassController extends Controller
{
    //

    public function show(): JsonResponse
    {
        $sizeclass = SizeClass::first();
        if(!$sizeclass) 
            return ApiResponse::notFound(message: 'kindly contact the admin');
        return ApiResponse::success(SizeClass::all());
    }

    public function store(SizeClassRequest $request): JsonResponse 
    {
        $sizeclass = SizeClass::create([
            'name'  => $request->name,
            'max_volume_cm3' => $request->max_volume_cm3
        ]);

        if(!$sizeclass) 
            return ApiResponse::error(message: 'Oops! something went wrong please contact tech OR try again later');
        return ApiResponse::success($sizeclass, 'You have successfully created a size classification');
    }
}
