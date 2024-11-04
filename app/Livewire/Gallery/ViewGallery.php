<?php

namespace App\Livewire\Gallery;

use Livewire\Component;
use App\Models\Gallery;
use App\Models\GalleryItem;

class ViewGallery extends Component
{

    public $gallery;
    public $slides;

    public function mount(Gallery $gallery)
    {
        $this->gallery = $gallery;
        $this->slides = $gallery->items()->orderBy('display_order')->get()->map(function ($slider) {
            return [
                'heading' => $slider->caption,
                'image' => $slider->getFirstMediaUrl(GalleryItem::GALLERY_MEDIA),
            ];
        });;
    }

    public function render()
    {
        return view('livewire.gallery.view-gallery');
    }
}
