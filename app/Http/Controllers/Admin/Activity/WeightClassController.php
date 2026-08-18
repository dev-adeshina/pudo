<?php

namespace App\Http\Controllers\Admin\Activity;

use App\Domains\Fulfilment\Delivery\Models\WeightClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WeightClassRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WeightClassController extends Controller
{
    //

    public function show(): JsonResponse
    {
        $weightclass = WeightClass::first();
        if(!$weightclass) 
            return ApiResponse::notFound(message: 'Please contact the admin');
        return ApiResponse::success(WeightClass::all());
    }


    public function store(WeightClassRequest $request): JsonResponse 
    {

        $weightclass = WeightClass::create([
            'name'      => $request->name,
            'min_kg'    => $request->min_kg,
            'max_kg'    => $request->max_kg
        ]);

        if(!$weightclass) 
            return ApiResponse::error(message: 'Oops, something went wrong please contact the tech');
        return ApiResponse::success($weightclass, "You have successfully created a weight classifcation");
    }
}


