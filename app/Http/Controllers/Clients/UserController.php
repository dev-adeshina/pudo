<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function user(Request $request): JsonResponse
    {
        $data = $request->user();

        if(!$data)
            return ApiResponse::forbidden();
        $user = User::with(['accessPoint', 'userExtended', 'userExtended.profileType'])->findOrfail($data->id);
        return ApiResponse::success(data: new UserResource($user));
        

       
    }
}


