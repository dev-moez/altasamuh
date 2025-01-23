<?php

namespace App\Livewire\Gallery;

use Livewire\Component;
use App\Models\Gallery;

class ListGalleries extends Component
{
    public function render()
    {
        $galleries = Gallery::orderBy('display_order')->paginate(12);
        return view('livewire.gallery.list-galleries', compact('galleries'));
    }
}
