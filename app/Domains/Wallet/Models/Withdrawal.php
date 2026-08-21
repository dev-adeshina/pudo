<?php

namespace App\Domains\Wallet\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('uuid', 'wallet_id', 'transaction_id', 'amount_minor', 'currency', 'status', 'destination_type', 'destination_reference', 'reference')]
class Withdrawal extends Model
{


    protected $casts = [
        'amount_minor' => 'integer',
    ];

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
}
