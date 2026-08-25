<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Domains\Delivery\Models\Trip;
class VRide extends Model
{
    //

    public function type(): BelongsTo
    {
        return $this->belongsTo(VRideType::class);
    }

    public function kyc(): HasOne 
    {
        return $this->hasOne(VRideKyc::class);
    }

    public function trip(): HasMany
    {
        return $this->hasMany(Trip::class);
    }
}
