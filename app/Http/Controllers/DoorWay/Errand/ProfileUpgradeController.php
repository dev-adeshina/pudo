<?php

namespace App\Http\Controllers\DoorWay\Errand;

use App\Http\Controllers\Controller;
use App\Http\Requests\Errand\ProfileUpgradeRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Responses\ApiResponse;
use App\Domains\Identity\Models\ErrandType;
use App\Domains\Identity\Models\Pudo;
use App\Enums\StatusEnum;
use App\Domains\Identity\Models\Skill;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProfileUpgradeController extends Controller
{
    public function upgrade(ProfileUpgradeRequest $request): JsonResponse
    {

        $user = $request->user();
        $data = $request->validated();


        if (! $this->hasPersonalprofile($user)) {
            return ApiResponse::forbidden(message: "Please get your personal profile intact first.");
        }

        try {

            $pudo = DB::transaction(function () use ($user, $data) {
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

                $type = ErrandType::where('name', $data['type'])->firstOrFail();

                $errand = $pudo->errand()->create([
                    'errand_type_id'    => $type->id,
                    'status'            => StatusEnum::PENDING
                ]);



                $errand->profile()->create([
                    'residential_address' => $data['residential_address'],
                    'emergency_contact_name' => $data['emergency_contact_name'],
                    'emergency_contact_mobile' => $data['emergency_contact_mobile'],
                    'availability' => $data['availability'],
                    'contact_verification' => $data['contact_verification'],
                    'description'   => $data['description'] ?? "blah blah black shoe how you doing"
                ]);

                if ($type->name === "SKILLED") {
                    $skill = Skill::where('name', $data['skill'])->firstOrFail();
                    $errand->skill()->create([
                        'skill_id' => $skill->id
                    ]);
                }

                return $pudo;
            });


            return ApiResponse::success($pudo);
        } catch (Throwable $e) {
            report($e);
            return ApiResponse::error(message: 'Unable to upgrade your profile at this time.');
        }
    }

    public function hasPersonalprofile(User $user): bool
    {
        return $user->personalprofile()->exists();
    }
}
