<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Model;
use App\Domains\Fulfilment\Items\Models\Item;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Domains\Identity\Models\VendorKyc;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Domains\Wallet\Models\Wallet;
use App\Domains\Wallet\Models\ComplianceProfile;

#[Fillable('user_id', 'profile_type_id', 'business_name', 'slug', 'status')]

class Vendor extends Model
{
    //

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function profileType(): BelongsTo
    {
        return $this->belongsTo(ProfileType::class);
    }

    public function location(): HasMany
    {
        return $this->hasMany(VendorLocation::class);
    }

    public function item(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function kyc(): HasOne
    {
        return $this->hasOne(VendorKyc::class);
    }

    public function wallet(): MorphOne
    {
        return $this->morphOne(Wallet::class, 'owner');
    }

    public function complianceProfile(): MorphOne
    {
        return $this->morphOne(ComplianceProfile::class, 'subject');
    }
}
