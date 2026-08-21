<?php

namespace App\Domains\Wallet\Models;


use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


#[Fillable('key', 'operation', 'request_hash', 'transaction_id', 'status', 'response', 'expires_at')]
class IdempotencyKey extends Model
{
    protected $casts = [
        'response' => 'array',
        'expires_at' => 'datetime',
    ];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
}
