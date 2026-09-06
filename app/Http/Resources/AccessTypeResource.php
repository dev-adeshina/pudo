<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Domains\Identity\Models\Client;
use App\Domains\Identity\Models\Admin;
use App\Domains\Identity\Models\Pudo;
use App\Domains\Identity\Models\Vendor;

class AccessTypeResource extends JsonResource
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

            'access_point' => new AccessPointResource(
                $this->whenLoaded('accessPoint')
            ),

            'accessable' => match ($this->accessable_type) {
                Client::class => new ClientResource($this->whenLoaded('accessable')),
                Admin::class => new AdminResource($this->whenLoaded('accessable')),
                Pudo::class => new PudoResource($this->whenLoaded('accessable')),
                // Vendor::class => new VendorResource($this->whenLoaded('accessable')),
                default  => null,
            },
        ];
    }
}
