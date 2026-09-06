<?php

namespace App\Http\Controllers\DoorWay\Client;

use App\Domains\Identity\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\StatusEnum;
use App\Http\Requests\Client\ProfileUpgradeRequest;

class ProfileUpgradeController extends Controller
{
    public function upgrade(ProfileUpgradeRequest $request)
    {
        $user = $request->user();
        $admin = Client::create([
            'user_id' => $user->id,
            'code' => 'CLI-' . strtoupper(uniqid()),
            'status' => StatusEnum::PENDING
        ]);

        $accesspoint = $user->accessPoint()->firstOrFail();
        $admin->accessType()->create([
            'access_point_id'   => $accesspoint->id,
            'user_id'           => $user->id,
            'is_active'         => true
        ]);

        $admin->profile()->create([
            'preferred_currency' => $request->input('preferred_currency'),
            'preferred_language' => $request->input('preferred_language')
        ]);

        
        

        return response()->json($admin);
    }
}
