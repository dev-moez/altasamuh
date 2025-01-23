<?php

namespace App\Livewire\Profile;

use Livewire\Component;

class ChangePassword extends Component
{

    public $password;
    public $password_confirmation;

    public function render()
    {
        return view('livewire.profile.change-password');
    }

    public function submit()
    {
        $this->resetErrorBag();
        $this->validate([
            'password' => ['required', 'min:8', 'max:20', 'confirmed'],
            'password_confirmation' => ['required', 'same:password'],
        ]);
        try {
            auth()->user()->update([
                'password' => bcrypt($this->password),
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('error-message', ['message' => 'حدث خطأ ما، يرجى المحاولة مرة أخرى']);
            return;
        }
        $this->dispatch('success-message', ['message' => 'لقد تم تغيير كلمة المرور بنجاح']);
    }
}
