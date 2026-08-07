<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;



#[Fillable(['name', 'slug', 'status'])]
class ProfileType extends Model
{
    //

    public function userExtends()
    {
        return $this->hasMany(UserExtend::class, 'profile_type_id');
    }
}
