<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


#[Fillable('vendor_id', 'label', 'address_line', 'city', 'state', 'country_code', 'latitude', 'longitude', 'is_primary')]
class VendorLocation extends Model
{
    //
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
}
