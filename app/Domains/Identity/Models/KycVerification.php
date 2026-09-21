<?php

namespace App\Domains\Identity\Models;


use App\Enums\Kyc\KycLevel;
use App\Enums\Kyc\KycStatus;
use App\Enums\Kyc\KycVerificationType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Fillable;



#[Fillable('kyc_id', 'level', 'type', 'provider', 'provider_reference', 'status', 'score', 'request_payload', 'response_payload', 'failure_reason', 'verified_at')]
class KycVerification extends Model
{

    protected function casts(): array
    {
        return [
            'level' => KycLevel::class,
            'type' => KycVerificationType::class,
            'status' => KycStatus::class,
            'request_payload' => 'encrypted:array',
            'response_payload' => 'encrypted:array',
            'verified_at' => 'datetime',
        ];
    }


    public function kyc(): BelongsTo
    {
        return $this->belongsTo(Kyc::class);
    }

}
