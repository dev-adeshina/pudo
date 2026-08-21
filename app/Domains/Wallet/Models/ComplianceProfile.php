<?php

namespace App\Domains\Wallet\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[Fillable('kyc_status', 'risk_level', 'verified_at', 'reviewed_at')]
class ComplianceProfile extends Model
{
    

    protected $casts = [
        'verified_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }
}
