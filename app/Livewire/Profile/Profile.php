<?php

namespace App\Livewire\Profile;

use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Country;

class Profile extends Component
{
    public $name;
    public $phone_number;
    #[Computed('countries')]
    public $countries;
    public $country_code;

    public function mount()
    {
        $this->countries = Country::all();
        $this->loadData();
    }
    public function render()
    {
        return view('livewire.profile.profile');
    }

    public function submit()
    {
        $this->resetErrorBag();
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => [
                'required',
                'max:12',
                'min:11'
                // 'regex:/^(\+965)?[2569]\d{7}$/'
            ],
            'country_code' => 'required',
        ]);

        try {
            auth()->user()->update([
                'name' => $this->name,
                'phone_number' => $this->phone_number,
                'country_code' => $this->country_code
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('error-message', ['message' => 'حدث خطأ ما، يرجى المحاولة مرة أخرى']);
            return;
        }
        $this->dispatch('success-message', ['message' => 'لقد تم تحديث الملف الشخصي بنجاح']);
        $this->loadData();
    }

    private function loadData()
    {
        $this->name = auth()->user()->name;
        $this->phone_number = auth()->user()->phone_number;
        $this->country_code = auth()->user()->country_code;
    }
}
