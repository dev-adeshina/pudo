<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('errand_certificate_id', 'method', 'provider', 'provider_reference', 'verified_by', 'verified_at', 'notes', 'status')]
class CertificateVerification extends Model
{
    public function errandcertificate(): BelongsTo
    {
        return $this->belongsTo(ErrandCertificate::class);
    }
}


