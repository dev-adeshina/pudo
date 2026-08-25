<?php

namespace App\Domains\Delivery\Models;

use App\Domains\Identity\Models\VRide;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('vride_id', 'type', 'available_at', 'departure', 'destination', 'start_latitude', 'start_longitude', 'seats_available', 'status')]
class Trip extends Model
{
    

    public function vride(): BelongsTo
    {
        return $this->belongsTo(VRide::class);
    }
}


