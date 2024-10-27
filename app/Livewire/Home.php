<?php

namespace App\Livewire;

use App\Models\HomeSlider;
use Livewire\Component;

class Home extends Component
{

    public $slides;
    public function mount()
    {
        $this->slides = HomeSlider::get()->map(function ($slider) {
            return [
                'heading' => $slider->heading,
                'sub_heading' => $slider->sub_heading,
                'image' => $slider->getFirstMediaUrl(HomeSlider::HOME_SLIDER_MEDIA_DESKTOP),
            ];
        });
    }
    public function render()
    {
        return view('livewire.home');
    }
}
