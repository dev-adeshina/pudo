<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('v_ride_id', 'type', 'document_number', 'file_path', 'issued_at', 'expires_at', 'status', 'verified_at', 'rejection_reason')]
class VRideDocument extends Model
{

    protected function casts(): array
    {
        return [
            'issued_at' => 'date',
            'expires_at' => 'date',
            'verified_at' => 'datetime',
        ];
    }

    public function vride(): BelongsTo
    {
        return $this->belongsTo(VRide::class);
    }
}
