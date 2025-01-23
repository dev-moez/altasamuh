<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use App\Models\Category;

class CategoryService
{
    public function getNavbarCategories()
    {
        // return Category::navbarCategories()->get();
        return Cache::remember('navbar_categories', 60 * 60, function () {
            return Category::navbarCategories()->get();
        });
    }
}
