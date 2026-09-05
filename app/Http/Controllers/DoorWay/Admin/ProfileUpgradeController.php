<?php

namespace App\Http\Controllers\DoorWay\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ProfileUpgradeRequest;
use App\Domains\Identity\Models\AdminProfile;
use App\Domains\Identity\Models\Admin;
use App\Enums\StatusEnum;

class ProfileUpgradeController extends Controller
{
    public function upgrade(ProfileUpgradeRequest $request)
    {
        $user = $request->user();
        $admin = Admin::create([
            'user_id' => $user->id,
            'code' => 'ADM-' . strtoupper(uniqid()),
            'status' => StatusEnum::PENDING
        ]);

        $accesspoint = $user->accessPoint()->firstOrFail();
        $admin->accessType()->create([
            'access_point_id'   => $accesspoint->id,
            'user_id'           => $user->id,
            'is_active'         => true
        ]);

        $admin->adminprofile()->create([
            'role' => $request->input('role'),
            'department' => $request->input('department')
        ]);

        
        

        return response()->json($admin);
    }
}


