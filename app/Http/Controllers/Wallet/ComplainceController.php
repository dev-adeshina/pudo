<?php

namespace App\Http\Controllers\Wallet;

use App\Domains\Identity\Models\ProfileType;
use App\Domains\Wallet\Services\ComplianceService;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ComplainceController extends Controller
{
    public function __construct(protected ComplianceService $service){}
    public function check(Request $request): JsonResponse
    {
        $user = $request->user();
        
        $feedback = $this->service->checkCompliance($user);
        

        return ApiResponse::success(message: $feedback);
            
    }
}
