<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable('admin_id', 'role', 'status', 'department')]
class AdminProfile extends Model
{
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
