<?php

namespace App\Livewire;

use App\Models\HomeSlider;
use Livewire\Component;
use App\Models\Article;
use App\Models\Category;
use App\Models\MiscDonation;
use App\Models\Project;
use Jenssegers\Agent\Agent;

class Home extends Component
{
    public $slides;
    public $articles;
    // public $projects;
    public $categories;
    public $currentCategoryId;

    public function mount()
    {
        $agent = new Agent();
        $this->slides = HomeSlider::get()->map(function ($slider) use ($agent) {
            return [
                // 'heading' => $slider->heading,
                // 'sub_heading' => $slider->sub_heading,
                'image' => $agent->isMobile() ? $slider->getFirstMediaUrl(HomeSlider::HOME_SLIDER_MEDIA_MOBILE) : $slider->getFirstMediaUrl(HomeSlider::HOME_SLIDER_MEDIA_DESKTOP),
                'link' => $slider->url
            ];
        });
        $this->articles = Article::pinned()->get();
        $this->categories = Category::where('display_on_homepage', true)->get();
        $this->currentCategoryId = $this->categories->first()?->id;
        // $this->updatedCurrentCategoryId();
    }
    public function render()
    {
        $projects = Project::published()
            ->where('display_in_homepage', true)
            ->when($this->currentCategoryId, function ($query) {
                $query->whereHas('categories', fn($query) => $query->where('categories.id', $this->currentCategoryId));
            })
            ->get();
        return view('livewire.home', compact('projects'));
    }

    // public function updateCurrentCategoryId()
    // {
    //     $this->projects = 
    //     // dd($this->projects);
    // }
}
