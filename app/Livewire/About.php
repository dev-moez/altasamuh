<?php

namespace App\Livewire;

use App\Models\BoardMember;
use Livewire\Component;
use Livewire\Attributes\Computed;

class About extends Component
{
    #[Computed]
    public $boardMembers;

    public function mount()
    {
        $this->boardMembers = BoardMember::all();
    }
    public function render()
    {
        return view('livewire.about');
    }
}
