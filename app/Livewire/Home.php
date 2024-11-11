<?php

namespace App\Livewire;

use App\Models\HomeSlider;
use Livewire\Component;
use App\Models\Article;
use App\Models\Category;
use App\Models\MiscDonation;
use App\Models\Project;

class Home extends Component
{
    public $slides;
    public $articles;
    // public $projects;
    public $categories;
    public $currentCategoryId;

    public function mount()
    {
        $this->slides = HomeSlider::get()->map(function ($slider) {
            return [
                'heading' => $slider->heading,
                'sub_heading' => $slider->sub_heading,
                'image' => $slider->getFirstMediaUrl(HomeSlider::HOME_SLIDER_MEDIA_DESKTOP),
            ];
        });
        $this->articles = Article::pinned()->get();
        $categoryIds = Project::published()->where('display_in_homepage', true)
            ->whereHas('categories', function ($query) {
                $query->select('categories.id')->distinct();
            })->pluck('id')->unique()->values()->toArray();
        // dd($categoryIds);
        $this->categories = Category::find($categoryIds);
        $this->currentCategoryId = $this->categories->first()->id;
        // $this->updatedCurrentCategoryId();
    }
    public function render()
    {
        $projects = Project::published()
            ->where('display_in_homepage', true)
            ->when($this->currentCategoryId, function ($query) {
                $query->whereHas('categories', fn($query) => $query->where('categories.id', $this->currentCategoryId));
            })
            // ->whereHas('categories', fn($query) => $query->where('categories.id', $this->currentCategoryId))
            ->get();
        return view('livewire.home', compact('projects'));
    }

    // public function updateCurrentCategoryId()
    // {
    //     $this->projects = 
    //     // dd($this->projects);
    // }
}
