<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\Donation;

class Donations extends Component
{
    public $donationsCount;
    public $donationsSum;
    public function mount()
    {
        $query = Donation::where('user_id', auth()->user()->id);
        $this->donationsCount = $query->clone()->count();
        $this->donationsSum = $query->clone()->sum('amount');
    }
    public function render()
    {
        $donations = Donation::where('user_id', auth()->user()->id)->paginate(10);
        return view('livewire.profile.donations', compact('donations'));
    }
}
