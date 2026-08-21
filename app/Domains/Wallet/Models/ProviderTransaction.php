<?php

namespace App\Domains\Wallet\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('provider_account_id', 'transaction_id', 'provider', 'provider_transaction_id', 'provider_reference', 'amount_minor', 'currency', 'status', 'raw_status', 'occurred_at')]
class ProviderTransaction extends Model
{
    protected $casts = [
        'amount_minor' => 'integer',
        'occurred_at' => 'datetime',
    ];

    public function providerAccount(): BelongsTo
    {
        return $this->belongsTo(ProviderAccount::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
}
