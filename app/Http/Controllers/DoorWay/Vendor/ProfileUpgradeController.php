<?php

namespace App\Http\Controllers\DoorWay\Vendor;

use App\Domains\Identity\Models\Pudo;
use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Vendor\ProfileUpgradeRequest;

class ProfileUpgradeController extends Controller
{
    public function upgrade(ProfileUpgradeRequest $request)
    {
        $user = $request->user();
        $pudo = Pudo::create([
            'user_id' => $user->id,
            'type' => 'VENDOR'
        ]);

        $accesspoint = $user->accessPoint()->firstOrFail();
        $pudo->accessType()->create([
            'access_point_id'   => $accesspoint->id,
            'user_id'           => $user->id,
            'is_active'         => true
        ]);

        $pudo->vendor()->create([
            'business_name' => $request->input('business_name'),
            'business_mobile' => $request->input('business_mobile'),
            'business_description'  => $request->input('description'),
            'slug' => $request->input('slug'),
            'status' => StatusEnum::PENDING
        ]);
        $pudo->vendor->profile()->create([
            'logo' => $request->input('logo') ?? "we are yet to complete this",
            'description' => $request->input('description'),
            'operating_hours' => $request->input('operating_hours')
        ]);
        

        return response()->json($pudo);
    }
}
