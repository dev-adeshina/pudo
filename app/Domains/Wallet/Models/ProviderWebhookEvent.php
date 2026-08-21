<?php

namespace App\Domains\Wallet\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable('provider', 'provider_event_id', 'event_type', 'provider_transaction_id', 'payload_hash', 'signature_valid', 'status', 'payload', 'processed_at')]
class ProviderWebhookEvent extends Model
{
    
    protected $fillable = [
        
    ];

    protected $casts = [
        'signature_valid' => 'boolean',
        'payload' => 'array',
        'processed_at' => 'datetime',
    ];
}
