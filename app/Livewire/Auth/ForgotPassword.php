<?php

namespace App\Livewire\Auth;

use App\Actions\ResetPasswordAction;
use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Country;

class ForgotPassword extends Component
{
    public $phoneNumber;
    public $countryCode;
    #[Computed('countries')]
    public $countries;

    public function mount()
    {
        $this->countries = Country::all();
    }

    public function render()
    {
        return view('livewire.auth.forgot-password');
    }

    public function submit()
    {
        $this->resetErrorBag();
        $this->validate([
            'phoneNumber' => ['required', 'exists:users,phone_number'],
            'countryCode' => ['required'],
        ]);

        try {
            (new ResetPasswordAction($this->countryCode, $this->phoneNumber))->execute();
            $this->dispatch('success-message', ['message' => 'لقد تم ارسال رسالة تغيير كلمة المرور بنجاح']);
        } catch (\Exception $e) {
            logger()->error($e);
            $this->dispatch('error-message', ['message' => 'حدث خطأ ما، يرجى المحاولة مرة أخرى']);
            return;
        }
    }
}
