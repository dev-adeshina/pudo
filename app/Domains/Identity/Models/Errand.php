<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Domains\Wallet\Models\Wallet;

#[Fillable('user_id', 'profile_type_id', 'errand_type_id', 'dob', 'residential_address', 'emergency_contact_name', 'emergency_contact_name', 'emergency_contact_mobile', 'contact_verification')]
class Errand extends Model
{

    public function type(): BelongsTo
    {
        return $this->belongsTo(ErrandType::class);
    }

    public function kyc(): HasOne
    {
        return $this->hasOne(ErrandKyc::class);
    }


    public function wallet(): MorphOne
    {
        return $this->morphOne(Wallet::class, 'owner');
    }
}
