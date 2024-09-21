<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFactory;

    const ROLE_USER = 'user';
    const ROLE_SUPER_ADMIN = 'super-admin';
    const ROLE_ADMIN = 'admin';
}
