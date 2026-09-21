<?php

namespace App\Http\Controllers\Kyc;

use Illuminate\Http\JsonResponse;
use App\Http\Responses\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kyc\VerifyByBvnRequest;

use App\Domains\Kyc\Actions\VerificationLevelOneAction;



class VerifyByBVNController extends Controller
{
    public function __construct(protected VerificationLevelOneAction $action){}
    public function __invoke(VerifyByBvnRequest $request): JsonResponse 
    {
        $document = $this->action->execute($request->user(), $request->validated());
        return ApiResponse::success(data: $document, message: 'Level 1 KYC verification submitted successfully.');
    }
}
