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
        'VIEW_CATEGORY' => 'عرض الاقسام',
        'CREATE_CATEGORY' => 'اضافة قسم',
        'EDIT_CATEGORY' => 'تعديل قسم',
        'DELETE_CATEGORY' => 'حذف قسم',
        // List for projects
        'VIEW_PROJECT' => 'عرض المشاريع',
        'CREATE_PROJECT' => 'اضافة مشروع',
        'EDIT_PROJECT' => 'تعديل مشروع',
        'DELETE_PROJECT' => 'حذف مشروع',
        // List for admins
        'VIEW_ADMIN' => 'عرض الادمن',
        'CREATE_ADMIN' => 'اضافة ادمن',
        'EDIT_ADMIN' => 'تعديل ادمن',
        'DELETE_ADMIN' => 'حذف ادمن',
        // List for users
        'VIEW_USER' => 'عرض المستخدمين',
        'EDIT_USER' => 'تعديل المستخدمين',
        'DELETE_USER' => 'حذف المستخدمين',
        // List for board members
        'VIEW_BOARD_MEMBER' => 'عرض عضو المجلس',
        'CREATE_BOARD_MEMBER' => 'اضافة عضو المجلس',
        'EDIT_BOARD_MEMBER' => 'تعديل عضو المجلس',
        'DELETE_BOARD_MEMBER' => 'حذف عضو المجلس',
        // List for contact messages
        'VIEW_CONTACT_MESSAGE' => 'عرض رسائل التواصل',
        'DELETE_CONTACT_MESSAGE' => 'حذف رسالة التواصل',
        // List for misc donations
        'VIEW_MISC_DONATION' => 'عرض التبرعات المتنوعة',
        'CREATE_MISC_DONATION' => 'اضافة تبرع متنوع',
        'DELETE_MISC_DONATION' => 'حذف تبرع متنوع',
        'EDIT_MISC_DONATION' => 'تعديل تبرع متنوع',
        // List misc donation values
        'VIEW_MISC_DONATION_VALUE' => 'عرض قيم التبرعات المتنوعة',
        'CREATE_MISC_DONATION_VALUE' => 'اضافة قيمة تبرع متنوع',
        'EDIT_MISC_DONATION_VALUE' => 'تعديل قيمة تبرع متنوع',
        'DELETE_MISC_DONATION_VALUE' => 'حذف قيمة تبرع متنوع',
        // List donations
        'VIEW_DONATION' => 'عرض التبرعات',
        'CREATE_DONATION' => 'اضافة تبرع يدويا',
        // List transactions
        'VIEW_TRANSACTION' => 'عرض المعاملات',
        // List Home slider
        'VIEW_HOME_SLIDER' => 'عرض السلايدر الرئيسي',
        'CREATE_HOME_SLIDER' => 'اضافة سلايدر رئيسي',
        'EDIT_HOME_SLIDER' => 'تعديل السلايدر الرئيسي',
        'DELETE_HOME_SLIDER' => 'حذف السلايدر الرئيسي',
        // List Galleries
        'VIEW_GALLERY' => 'عرض المعارض',
        'CREATE_GALLERY' => 'اضافة معرض',
        'EDIT_GALLERY' => 'تعديل معرض',
        'DELETE_GALLERY' => 'حذف معرض',
        // List Affiliate
        'VIEW_AFFILIATE' => 'عرض روابط الإعلانات',
        'CREATE_AFFILIATE' => 'اضافة رابط اعلان',
        'EDIT_AFFILIATE' => 'تعديل رابط اعلان',
        'DELETE_AFFILIATE' => 'حذف رابط اعلان',
        // List Articles
        'VIEW_ARTICLE' => 'عرض المقالات',
        'CREATE_ARTICLE' => 'اضافة مقالة',
        'EDIT_ARTICLE' => 'تعديل مقالة',
        'DELETE_ARTICLE' => 'حذف مقالة',
        // List Countries
        'VIEW_COUNTRY' => 'عرض الدول',
        'CREATE_COUNTRY' => 'اضافة دولة',
        'EDIT_COUNTRY' => 'تعديل دولة',
        'DELETE_COUNTRY' => 'حذف دولة',
        // General Settings
        'EDIT_GENERAL_SETTINGS' => 'تعديل الاعدادات العامة',
        // Export
        'EXPORT_DONATIONS' => 'تصدير التبرعات',
        'EXPORT_PROJECTS' => 'تصدير المشاريع',
        'EXPORT_USERS' => 'تصدير المستخدمين',
        'EXPORT_TRANSACTIONS' => 'تصدير المعاملات',
        // StatsOverview
        'VIEW_INSIGHTS' => 'عرض الإحصاءات'
    ];
}
