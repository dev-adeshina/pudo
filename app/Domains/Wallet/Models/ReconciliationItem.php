<?php

namespace App\Domains\Wallet\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('reconciliation_run_id', 'transaction_id', 'provider_transaction_id', 'internal_amount_minor', 'provider_amount_minor', 'difference_minor', 'status', 'reason')]
class ReconciliationItem extends Model
{


    protected $casts = [
        'internal_amount_minor' => 'integer',
        'provider_amount_minor' => 'integer',
        'difference_minor' => 'integer',
    ];

    public function reconciliationRun(): BelongsTo
    {
        return $this->belongsTo(
            ReconciliationRun::class
        );
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function providerTransaction(): BelongsTo
    {
        return $this->belongsTo(
            ProviderTransaction::class
        );
    }
}
