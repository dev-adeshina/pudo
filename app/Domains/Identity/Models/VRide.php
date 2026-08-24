<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
}
