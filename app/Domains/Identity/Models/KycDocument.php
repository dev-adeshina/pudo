<?php

namespace App\Domains\Identity\Models;


use App\Enums\Kyc\KycStatus;
use App\Enums\Kyc\KycDocumentType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


#[Fillable('kyc_id', 'type', 'country', 'document_number', 'provider', 'provider_reference', 'status', 'file_path', 'file_url', 'metadata', 'provider_response', 'failure_reason', 'verified_at')]
class KycDocument extends Model
{
    protected function casts(): array
    {
        return [
            'type' => KycDocumentType::class,
            'status' => KycStatus::class,
            'metadata' => 'array',
            'provider_response' => 'encrypted:array',
            'verified_at' => 'datetime',
        ];
    }

    public function kyc(): BelongsTo
    {
        return $this->belongsTo(Kyc::class);
    }
}
