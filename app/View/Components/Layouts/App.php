<?php

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Services\CategoryService;

class App extends Component
{
    protected $categoryService;
    public $navbarCategories;

    /**
     * Create a new component instance.
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->navbarCategories = $this->categoryService->getNavbarCategories();
        dd($this->navbarCategories);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.app', [
            'navbarCategories' => $this->navbarCategories
        ]);
    }
}
