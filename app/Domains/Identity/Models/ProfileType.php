<?php

namespace App\Domains\Identity\Models;

use App\Domains\Feedback\Services\FeedbackService;
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

    public function getEntityClass(): string
    {
        return match(strtolower($this->slug)) 
        {
            'errand'    => ErrandType::class,
            'vendor'    => Vendor::class,
            'vride'     => VRide::class,
            'pudo'      => PudoType::class,
            default   => throw new \InvalidArgumentException("Invalid profile type: {$this->type}"),
        };
    }
}
