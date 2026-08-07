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
        // return parent::toArray($request);
        return [
            'name' => $this->name,
            'email' => $this->email,
            'access' => new AccessPointResource($this->whenLoaded('access')),
            'profileType' => new ProfileTypeResource($this->whenLoaded('profileType')),
            'meta' => new UserExtendResource($this->whenLoaded('userExtended')), 

        ];
    }
}
