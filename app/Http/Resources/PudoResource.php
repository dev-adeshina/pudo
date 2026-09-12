<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PudoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'vendor' => new VendorResource(
                $this->whenLoaded('vendor')
            ),

            'errand' => new ErrandResource(
                $this->whenLoaded('errand')
            ),

            'vride' => new VRideResource(
                $this->whenLoaded('vride')
            ),
            'agent' => new AgentResource(
                $this->whenLoaded('agent')
            ),
            'actor' => new ActorResource(
                $this->whenLoaded('actor')
            ),

        ];
    }
}
