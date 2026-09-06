<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AccessPointResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $profileLink = "/api/v1/personal-profile";
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'email'     => $this->email,
            'mobile'    => $this->mobile,
            'authorizations' => new AccessPointResource($this->whenLoaded('accessPoint')),
            'personal_profile' => $this->personalProfile === null ?  "Fill in your profile...".$profileLink  : new PersonalProfileResource($this->whenLoaded('personalProfile')),
            
            'access_types' => AccessTypeResource::collection($this->whenLoaded('accessTypes')),

        ];
    }
}
