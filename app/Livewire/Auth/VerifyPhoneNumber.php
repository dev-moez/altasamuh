<?php

namespace App\Livewire\Auth;

use App\Models\PhoneNumberVerification;
use Livewire\Component;
use App\Models\User;

class VerifyPhoneNumber extends Component
{
    public $otp;
    public $phone_number;
    public $user_id;

    public function mount()
    {
        $this->phone_number = auth()->user()->phone_number;
        $this->user_id = auth()->id();
    }
    public function render()
    {
        return view('livewire.auth.verify-phone-number');
    }

    public function submit()
    {
        $this->validate([
            'otp' => ['required', 'exists:phone_number_verifications,otp'],
        ]);
        if (PhoneNumberVerification::where([
            'otp' => $this->otp,
            'phone_number' => $this->phone_number,
            'user_id' => $this->user_id
        ])->exists()) {
            User::where('id', $this->user_id)
                ->update(['phone_verified_at' => now()]);

            return redirect()->route('home');
        }
    }
}
