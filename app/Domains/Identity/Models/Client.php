<?php

namespace App\Domains\Identity\Models;

use App\Models\AccessType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use App\Models\User;

#[Fillable('user_id', 'code','status')]
class Client extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }   

    public function profile(): HasOne
    {
        return $this->hasOne(ClientProfile::class, 'client_id', 'id');
    }

    public function accessType(): MorphMany
    {
        return $this->morphMany(AccessType::class, 'accessable');
    }
}
