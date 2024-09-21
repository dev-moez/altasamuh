<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HasFactory;

    protected $fillable = [
        'name',
        'guard_name',
    ];
    const PERMISSION_LIST = [
        'VIEW_CATEGORY' => 'view categories',
        'CREATE_CATEGORY' => 'create categories',
        'EDIT_CATEGORY' => 'edit categories',
        'DELETE_CATEGORY' => 'delete categories',
        // List for projects
        'VIEW_PROJECT' => 'view projects',
        'CREATE_PROJECT' => 'create projects',
        'EDIT_PROJECT' => 'edit projects',
        'DELETE_PROJECT' => 'delete projects',
        // List for admins
        'VIEW_ADMIN' => 'view admins',
        'CREATE_ADMIN' => 'create admins',
        'EDIT_ADMIN' => 'edit admins',
        'DELETE_ADMIN' => 'delete admins',
        // List for users
        'VIEW_USER' => 'view users',
        'CREATE_USER' => 'create users',
        'EDIT_USER' => 'edit users',
        'DELETE_USER' => 'delete users',
        // List for board members
        'VIEW_BOARD_MEMBER' => 'view board members',
        'CREATE_BOARD_MEMBER' => 'create board members',
        'EDIT_BOARD_MEMBER' => 'edit board members',
        'DELETE_BOARD_MEMBER' => 'delete board members',
        // List for contact messages
        'VIEW_CONTACT_MESSAGE' => 'view contact messages',
        'DELETE_CONTACT_MESSAGE' => 'delete contact messages',
    ];
}
