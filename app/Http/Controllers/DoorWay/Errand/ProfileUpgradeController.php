<?php

namespace App\Http\Controllers\DoorWay\Errand;

use App\Domains\Identity\Models\ErrandProfile;
use App\Http\Controllers\Controller;
use App\Http\Requests\Errand\ProfileUpgradeRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Responses\ApiResponse;
use App\Domains\Identity\Models\ErrandType;
use App\Domains\Identity\Models\Pudo;
use App\Enums\StatusEnum;
use App\Domains\Identity\Models\Skill;

class ProfileUpgradeController extends Controller
{
    public function upgrade(ProfileUpgradeRequest $request): JsonResponse 
    {
        $user = $request->user();

        $pudo = Pudo::create([
            'user_id' => $user->id,
            'type' => 'ERRAND'
        ]);

        $accesspoint = $user->accessPoint()->firstOrFail();
        $pudo->accessType()->create([
            'access_point_id'   => $accesspoint->id,
            'user_id'           => $user->id,
            'is_active'         => true
        ]);

        $type = ErrandType::where('name', $request->type)->firstOrFail();

        $errand = $pudo->errand()->create([
            'errand_type_id'    => $type->id,
            'status'            => StatusEnum::PENDING
        ]);



        $errand->profile()->create([
            'residential_address' => $request->residential_address,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_mobile' => $request->emergency_contact_mobile,
            'availability' => $request->availability,
            'contact_verification' => $request->contact_verification,
            'description'   => "blah blah black shoe how you doing" 
        ]);

        if($type->name === "SKILLED") {
            $skill = Skill::where('name', $request->skill)->firstOrFail();
            $errand->skill()->create([
                'skill_id' => $skill->id
            ]);
        }
        

        return ApiResponse::success([
            $pudo,
            $errand,
            'residential_address' => $request->residential_address,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_mobile' => $request->emergency_contact_mobile,
            'availability' => $request->availability,
            'contact_verification' => $request->contact_verification,
            'description'   => "blah blah black shoe how you doing" 
        ]);
    }
}


