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
        $profileLink = "/api/v1/profile";
        return [
            'name'      => $this->name,
            'email'     => $this->email,
            'mobile'    => $this->mobile,
            'access'    => new AccessPointResource($this->whenLoaded('accessPoint')),
            
            // 'extended' => $this->userExtended === null ?  "Fill in your profile...".$profileLink  : new UserExtendResource($this->whenLoaded('userExtended')), 

        ];
    }
}
