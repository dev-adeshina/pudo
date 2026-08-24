<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('vendor_id', 'id_type', 'code', 'front_image_path', 'back_image_path', 'status', 'lookup_provider', 'selfie', 'provider_trnx', 'provider_meta')]
class VendorKyc extends Model
{
    //

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
}


