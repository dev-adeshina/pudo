<?php 

namespace App\Http\Controllers\DoorWay\Vride;

use Throwable;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Responses\ApiResponse;
use App\Http\Controllers\Controller;
use App\Domains\Identity\Models\Pudo;
use App\Enums\StatusEnum;
use App\Http\Requests\Vride\ProfileUpgradeRequest;


class ProfileUpgradeController extends Controller
{
    public function upgrade(ProfileUpgradeRequest $request): JsonResponse
    {
        $user = $request->user();
        $data = $request->validated();

        if (! $this->hasPersonalprofile($user)) {
            return ApiResponse::forbidden(message: "Please get your personal profile intact first.");
        }

        try{

            $vride = DB::transaction(function () use($user, $data) {
                $pudo = Pudo::create([
                    'user_id' => $user->id,
                    'type' => 'VRIDE'
                ]);

                $accesspoint = $user->accessPoint()->firstOrFail();
                $pudo->accessType()->create([
                    'access_point_id'   => $accesspoint->id,
                    'user_id'           => $user->id,
                    'is_active'         => true
                ]);

                $vride = $pudo->vride()->create([
                    'status'    => StatusEnum::PENDING
                ]);

                $vride->profile()->create([
                    'bio'  => $data['bio'],
                    'years_of_experience'       => $data['years_of_experience'],
                    'residential_address'       => $data['residential_address'],
                    'emergency_contact_name'    => $data['emergency_contact_name'],
                    'emergency_contact_phone'   => $data['emergency_contact_phone']
                ]);

            });

            return ApiResponse::success($vride);

        }catch(Throwable $e){
            report($e);
            return ApiResponse::error($e);
        }

        
       
    }

    public function hasPersonalprofile(User $user): bool
    {
        return $user->personalprofile()->exists();
    }
}