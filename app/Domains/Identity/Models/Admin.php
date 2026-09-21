<?php

namespace App\Domains\Identity\Models;

use App\Models\AccessType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable('user_id', 'code','status')]
class Admin extends Model
{
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function profile(): HasOne
    {
        return $this->hasOne(AdminProfile::class, 'admin_id', 'id');
    }

    public function accessType(): MorphMany
    {
        return $this->morphMany(AccessType::class, 'accessable');
    }

    public function kyc(): MorphOne
    {
        return $this->morphOne(Kyc::class, 'kycable');
    }
}
