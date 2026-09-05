<?php 

namespace  App\Enums\Admin;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case SUPERADMIN = 'super-admin';
    case JUNIORADMIN = 'junior-admin';
}