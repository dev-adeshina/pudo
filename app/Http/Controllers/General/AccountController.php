<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Domains\Identity\Models\Client;
use App\Domains\Identity\Models\Admin;
use App\Domains\Identity\Models\Pudo;

class AccountController extends Controller
{
    public function account(Request $request): JsonResponse
    {
        $data = $request->user();

        if(!$data)
            return ApiResponse::forbidden();
        
        
        $user = User::with(['accessPoint',  'accessTypes.accessable' => function ($morphTo) {
        $morphTo->morphWith([
            Client::class => [
                'profile',
            ],

            Admin::class => [
                'profile',
            ],

            Pudo::class => [
                'vendor', 
                'vendor.profile',
                'errand',
                // 'vride',
            ],
        ]);
    },])->findOrfail($data->id);
        return ApiResponse::success(data: new UserResource($user));
        

       
    }
}
