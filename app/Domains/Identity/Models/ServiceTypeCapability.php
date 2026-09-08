<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class ServiceTypeCapability extends Model
{
    // public function capabilities(): BelongsToMany
    // {
    //     return $this->belongsToMany(
    //         Capability::class,
    //         'service_type_capabilities'
    //     );
    // }
}
