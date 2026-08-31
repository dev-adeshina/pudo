<?php

namespace App\Http\Controllers\Wallet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domains\Wallet\Services\WalletService;
use Illuminate\Http\JsonResponse;
use App\Http\Responses\ApiResponse;
use App\Domains\Wallet\Models\Wallet;
use App\Http\Resources\WalletResource;

class WalletController extends Controller
{
    public function __construct(protected WalletService $service){}

    public function show(Request $request): JsonResponse
    {
        $wallet = $this->service->getWallet($request->user());
        if(!$wallet) 
            return ApiResponse::notFound(message: "Sorry you have start creating your account");
        return ApiResponse::success(data: new WalletResource($wallet), message: "Wallet retrived successfully");
    }

     public function store(Request $request): JsonResponse
        {
            $wallet = $this->service->createWallet($request->user());
            return ApiResponse::success(data: new WalletResource($wallet), message: "Wallet retrived successfully");
            
        }

    public function getOrCreate(Request $request): JsonResponse
    {
        $wallet = $this->service->getOrCreateWallet($request->user());
        return ApiResponse::success(data: new WalletResource($wallet), message: "Wallet retrived successfully");
        
    }
}
