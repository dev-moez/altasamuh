<?php

namespace App\Livewire;

use App\Models\BoardMember;
use App\Settings\GeneralSettings;
use Livewire\Component;
use Livewire\Attributes\Computed;

class About extends Component
{
    #[Computed]
    public $boardMembers;


    public function mount()
    {
        $this->boardMembers = BoardMember::orderBy('position')->get();
    }

    public function render()
    {
        $generalSettings = app(GeneralSettings::class);
        return view('livewire.about', compact('generalSettings'));
    }
}
