<?php

namespace App\Http\Controllers\Wallet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domains\Wallet\Actions\OnboardCustomerAction;
use App\Http\Responses\ApiResponse;
use Dedoc\Scramble\Attributes\Api;
use Illuminate\Http\JsonResponse;

class OnboardCustomerController extends Controller
{
    //

    public function __construct(protected OnboardCustomerAction $action){}

    public function onboardCustomer(Request $request): JsonResponse
    {
        $this->action->execute($request->user());
        return ApiResponse::success(message: "Customer onboarding process started successfully");
    }
    
}
