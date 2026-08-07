<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;



#[Fillable(['name', 'slug', 'is_active'])]
class AccessPoint extends Model
{
    //
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
