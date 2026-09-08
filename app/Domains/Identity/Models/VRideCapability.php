<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('vride_id', 'capability_id', 'status', 'verified_at')]
class VRideCapability extends Model
{
    protected function casts(): array
    {
        return [
            'verified_at' => 'datetime',
        ];
    }

    public function vRide(): BelongsTo
    {
        return $this->belongsTo(VRide::class);
    }

    public function capability(): BelongsTo
    {
        return $this->belongsTo(Capability::class);
    }
}
