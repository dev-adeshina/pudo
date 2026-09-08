<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(
    'vride_id',
    'vehicle_type_id',
    'registration_number',
    'make',
    'model',
    'year',
    'color',
    'status',
)]
class Vehicle extends Model
{
    public function vride(): BelongsTo
    {
        return $this->belongsTo(VRide::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(VehicleDocument::class);
    }
}
