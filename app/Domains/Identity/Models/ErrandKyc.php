<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('brand_id', 'current_location', 'service_area', 'availability', 'id_type', 'code', 'front_image_path', 'back_image_path', 'status', 'lookup_provider', 'selfie', 'provider_trnx', 'provider_meta')]
class ErrandKyc extends Model
{
    //

    public function errand(): BelongsTo
    {
        return $this->belongsTo(Errand::class);
    }
}


