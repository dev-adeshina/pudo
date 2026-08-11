<?php

namespace App\Http\Controllers\DoorWay;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    //

    public function logout(Request $request): JsonResponse 
    {
        $user = $request->user();
 
       if($user?->currentAccessToken()) {
            $user->tokens()->delete();
       }

        return ApiResponse::success(data: "User Logout Successfully");
    }
}
