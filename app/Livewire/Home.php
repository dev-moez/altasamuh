<?php

namespace App\Livewire;

use App\Models\HomeSlider;
use Livewire\Component;
use App\Models\Article;
use App\Models\MiscDonation;
use App\Models\Project;

class Home extends Component
{
    public $slides;
    public $articles;
    public $projects;
    public $miscDonations;

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
        $this->projects = Project::get();
        $this->miscDonations = MiscDonation::get();
    }
    public function render()
    {
        return view('livewire.home');
    }
}
