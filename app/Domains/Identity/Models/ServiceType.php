<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable('name', 'slug', 'description', 'is_active')]
class ServiceType extends Model
{
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function vRideServices(): HasMany
    {
        return $this->hasMany(VRideService::class);
    }

    public function vehicleTypes(): BelongsToMany
    {
        return $this->belongsToMany(
            VehicleType::class,
            'service_type_vehicle_types'
        );
    }

    public function capabilities(): BelongsToMany
    {
        return $this->belongsToMany(
            Capability::class,
            'service_type_capabilities'
        );
    }

    public function requirements(): HasMany
    {
        return $this->hasMany(ServiceTypeRequirement::class);
    }
}
