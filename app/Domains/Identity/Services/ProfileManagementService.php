<?php 

namespace App\Domains\Identity\Services;

use App\Domains\Feedback\Services\FeedbackService;
use App\Domains\Identity\Models\ProfileType;
use App\Models\User;

class ProfileManagementService 
{
    public function __construct(protected FeedbackService $feedService){}

    public function onboarding(User $user, ProfileType $type, object $data)
    {
        $entityClass = $type->getEntityClass();

        $exists = $entityClass::where('user_id', $user->id)->first();

        if($exists)
            return $this->feedService->warning(message: "User already has a {$type->type} profile.");

        $profile = $entityClass::create([
            'user_id'   => $user->id, 
            'slug'      => $data->slug ?? null,
            'status'    => $data->status ?? null,
            'profile_type_id'   => $data->profile_type_id ?? null,
            'business_name'     => $data->business_name ?? null,
            'description'   => $data->description ?? null,
            'requires_drivers_license'  => $data->requires_drivers_license ?? null,
            'requires_vehicle_registration' => $data->requires_vehicle_registration ?? null,
            'requires_insurance'    => $data->requires_insurance ?? null,
            'is_active' => $data->is_active ?? null
        ]);

        return $this->feedService->success(
                message: ucfirst($type->type) . " profile created successfully.",
                meta: ['profile' => $profile]
            );
    }

}