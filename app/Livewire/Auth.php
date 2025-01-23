<?php

namespace App\Livewire;

use Livewire\Component;

class Auth extends Component
{

    public $activeTab;
    public function mount()
    {
        $this->activeTab = 'loginTab';
    }
    public function render()
    {
        return view('livewire.auth');
    }
}
