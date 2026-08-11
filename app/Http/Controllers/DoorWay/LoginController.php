<?php

namespace App\Http\Controllers\DoorWay;

use App\Http\Controllers\Controller;
use App\Http\Requests\Doorway\LoginRequest;
use App\Http\Resources\UserResource;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;






class LoginController extends Controller
{
    public function authenticate(LoginRequest $request): JsonResponse
    {

        $user = User::query()->where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return ApiResponse::error(
                message: 'Invalid credentials',
                statusCode: 401
            );
        }

        $token = $user->createToken($request->device_name);

        return ApiResponse::success(
            data: ['user' => new UserResource($user), 'token' => $token->plainTextToken],
            message: 'Login successful'
        );
    }
}
