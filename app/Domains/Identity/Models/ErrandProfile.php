<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('errand_id', 'residential_address', 'description', 'emergency_contact_name', 'emergency_contact_mobile', 'availability', 'contact_verification')]
class ErrandProfile extends Model
{
    public function errand(): BelongsTo
    {
        return $this->belongsTo(Errand::class);
    }
}


