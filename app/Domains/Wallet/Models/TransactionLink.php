<?php

namespace App\Domains\Wallet\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('source_transaction_id', 'destination_transaction_id', 'relationship_type', 'amount_minor')]
class TransactionLink extends Model
{
   

    protected $casts = [
        'amount_minor' => 'integer',
    ];

    public function source(): BelongsTo
    {
        return $this->belongsTo(
            Transaction::class,
            'source_transaction_id'
        );
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(
            Transaction::class,
            'destination_transaction_id'
        );
    }
}
