<?php

namespace App\Http\Controllers\Admin\Activity;

use App\Domains\Fulfilment\Delivery\Models\LogisticsProfile;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LogisticProfileRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogisticsProfileController extends Controller
{
    //

    public function show(): JsonResponse
    {
        $logisticsProfile = LogisticsProfile::first();
        if(!$logisticsProfile) 
            return ApiResponse::notFound(message: 'The admin is yet to create one. notify the admin');
        return ApiResponse::success(LogisticsProfile::all());
    }

    public function store(LogisticProfileRequest $request): JsonResponse 
    {
        $logisticsProfile = LogisticsProfile::create([
            'name'          => $request->name,
            'description'   => $request->description
        ]);

        if(!$logisticsProfile)
            return ApiResponse::error('Oops something went wrong, please try again later or notify tech-department');

        return ApiResponse::success($logisticsProfile);
    }
}
