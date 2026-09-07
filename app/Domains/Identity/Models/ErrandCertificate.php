<?php

namespace App\Domains\Identity\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('skill_id', 'errand_id', 'certificate_number', 'title', 'issuer_name', 'issued_at', 'expires_at', 'document_disk', 'document_path', 'status')]
class ErrandCertificate extends Model
{
    public function errand(): BelongsTo 
    {
        return $this->belongsTo(Errand::class);
    }

    public function skill(): BelongsTo 
    {
        return $this->belongsTo(Skill::class);
    }
}

