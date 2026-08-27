<?php

namespace App\Http\Controllers\DoorWay;

use App\Http\Controllers\Controller;
use App\Http\Requests\Doorway\RegisterRequest;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class BaseRegisterController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse 
    {

        $user = User::create([
            'access_point_id' => $request->route('access_point_id'),
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'mobile'    => $request->mobile,
            'password' => Hash::make($request->validated('password')),
        ]);
        event(new Registered($user));
        return ApiResponse::success( data: $user, message: 'User registered successfully');

    }
}
