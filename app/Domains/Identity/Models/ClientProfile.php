<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
#[Fillable('client_id', 'preferred_currency', 'preferred_language')]
class ClientProfile extends Model
{
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
