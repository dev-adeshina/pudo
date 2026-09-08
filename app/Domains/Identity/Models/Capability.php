<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable('name', 'slug', 'description')]
class Capability extends Model
{
    public function vRideCapabilities(): HasMany
    {
        return $this->hasMany(VRideCapability::class);
    }

    public function serviceTypes(): BelongsToMany
    {
        return $this->belongsToMany(
            ServiceType::class,
            'service_type_capabilities'
        );
    }
}
