<?php

namespace App\Domains\Wallet\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable('transaction_id', 'screening_type', 'result', 'risk_score', 'status', 'reviewed_by', 'reviewed_at')]
class TransactionScreening extends Model
{

    protected $casts = [
        'risk_score' => 'integer',
        'reviewed_at' => 'datetime',
    ];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
