<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('user_id', 'profile_type_id', 'code', 'status', 'metadata')]
class UserExtend extends Model
{
    //

   public function profileType(): BelongsTo
    {
        return $this->belongsTo(ProfileType::class, 'profile_type_id');
    }
}
