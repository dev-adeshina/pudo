<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable('name', 'slug', 'description', 'is_active')]
class VehicleType extends Model
{
    
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    // public function serviceTypes(): BelongsToMany
    // {
    //     return $this->belongsToMany(
    //         ServiceType::class,
    //         'service_type_vehicle_types'
    //     );
    // }
}
