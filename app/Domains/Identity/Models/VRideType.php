<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable('name', 'slug', 'status')]
class VRideType extends Model
{
    
    public function vride(): HasMany
    {
        return $this->hasMany(VRide::class);
    }
}
