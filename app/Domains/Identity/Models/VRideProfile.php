<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


#[Fillable(
    'vride_id',
    'bio',
    'years_of_experience',
    'residential_address',
    'emergency_contact_name',
    'emergency_contact_phone'
)]
class VRideProfile extends Model
{
    //

    public function VRide(): BelongsTo
    {
        return $this->belongsTo(VRide::class);
    }
}
