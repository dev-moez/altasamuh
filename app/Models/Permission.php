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
        // List for misc donations
        'VIEW_MISC_DONATION' => 'view misc donations',
        'DELETE_MISC_DONATION' => 'delete misc donations',
        'EDIT_MISC_DONATION' => 'edit misc donations',
        // List misc donation values
        'VIEW_MISC_DONATION_VALUE' => 'view misc donation values',
        'CREATE_MISC_DONATION_VALUE' => 'create misc donation values',
        'EDIT_MISC_DONATION_VALUE' => 'edit misc donation values',
        'DELETE_MISC_DONATION_VALUE' => 'delete misc donation values',

        // List donations
        'VIEW_DONATION' => 'view donations',
        // List transactions
        'VIEW_TRANSACTION' => 'view transactions',
        // List Project Quick Donations
        'VIEW_PROJECT_QUICK_DONATION' => 'view project quick donations',
        'CREATE_PROJECT_QUICK_DONATION' => 'create project quick donations',
        'EDIT_PROJECT_QUICK_DONATION' => 'edit project quick donations',
        'DELETE_PROJECT_QUICK_DONATION' => 'delete project quick donations',
        // List Home slider
        'VIEW_HOME_SLIDER' => 'view home slider',
        'CREATE_HOME_SLIDER' => 'create home slider',
        'EDIT_HOME_SLIDER' => 'edit home slider',
        'DELETE_HOME_SLIDER' => 'delete home slider',
        // List Galleries
        'VIEW_GALLERY' => 'view galleries',
        'CREATE_GALLERY' => 'create galleries',
        'EDIT_GALLERY' => 'edit galleries',
        'DELETE_GALLERY' => 'delete galleries',
        // List Affiliate
        'VIEW_AFFILIATE' => 'view affiliates',
        'CREATE_AFFILIATE' => 'create affiliates',
        'EDIT_AFFILIATE' => 'edit affiliates',
        'DELETE_AFFILIATE' => 'delete affiliates',
        // List Articles
        'VIEW_ARTICLE' => 'view articles',
        'CREATE_ARTICLE' => 'create articles',
        'EDIT_ARTICLE' => 'edit articles',
        'DELETE_ARTICLE' => 'delete articles',
        // List Countries
        'VIEW_COUNTRY' => 'view countries',
        'CREATE_COUNTRY' => 'create countries',
        'EDIT_COUNTRY' => 'edit countries',
        'DELETE_COUNTRY' => 'delete countries',
        // General Settings
        'VIEW_GENERAL_SETTINGS' => 'view general settings',
        // Export
        'EXPORT_DONATIONS' => 'export donations',
        'EXPORT_PROJECTS' => 'export projects',
        'EXPORT_USERS' => 'export users',
        'EXPORT_TRANSACTIONS' => 'export transactions',

    ];
}
