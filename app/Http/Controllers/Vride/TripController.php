<?php

namespace App\Http\Controllers\Vride;

use App\Domains\Vride\Actions\TripAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vride\TripRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TripController extends Controller
{
    public function __construct(protected TripAction $action){}

    public function createTrip(TripRequest $dto): JsonResponse 
    {
        $result =  $this->action->execute($dto);
        return ApiResponse::success($result, message: "Trip created successfully");
    }
}
