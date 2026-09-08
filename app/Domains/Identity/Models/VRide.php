<?php

namespace App\Domains\Identity\Models;

use App\Domains\Delivery\Models\Trip;
use App\Domains\Wallet\Models\ComplianceProfile;
use App\Domains\Wallet\Models\Wallet;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

#[Fillable('pudo_id', 'status')]
class VRide extends Model
{
    //
    public function pudo(): BelongsTo
    {
        return $this->belongsTo(Pudo::class);
    }

    public function profile(): HasOne
    {
        return $this->hasOne(VRideProfile::class);
    }

    public function kyc(): HasOne
    {
        return $this->hasOne(VRideKyc::class);
    }

    // public function documents(): HasMany
    // {
    //     return $this->hasMany(VRideDocument::class);
    // }

    // public function vehicles(): HasMany
    // {
    //     return $this->hasMany(Vehicle::class);
    // }

    // public function services(): HasMany
    // {
    //     return $this->hasMany(VRideService::class);
    // }

    // public function capabilities(): HasMany
    // {
    //     return $this->hasMany(VRideCapability::class);
    // }

    public function trip(): HasMany
    {
        return $this->hasMany(Trip::class);
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
