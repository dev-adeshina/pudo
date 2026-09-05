<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonalProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'gender' => $this->gender,
            'dob' => $this->dob,
            'profile_photo_path' => $this->profile_photo_path,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country
        ];
    }
}
