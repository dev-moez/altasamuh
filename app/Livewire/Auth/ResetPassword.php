<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ResetPassword extends Component
{
    public $newPassword;
    public $confirmPassword;
    public $requestedToken;
    public function mount()
    {
        $token = request()->route('token');
        $this->requestedToken = DB::table('password_reset_tokens')->where('token', $token)->first();
    }
    public function render()
    {
        return view('livewire.auth.reset-password');
    }

    public function submit()
    {
        $this->resetErrorBag();
        $this->validate([
            'newPassword' => ['required'],
            'confirmPassword' => ['required', 'same:newPassword'],
        ]);

        if (!$this->requestedToken) {
            $this->dispatch('error-message', ['message' => 'هذا الرمز غير صحيح']);
            return false;
        }

        try {
            DB::table('users')->where('phone_number', $this->requestedToken->phone_number)->update(['password' => bcrypt($this->newPassword)]);
            DB::table('password_reset_tokens')->where('phone_number', $this->requestedToken->phone_number)->delete();
            $this->dispatch('success-message', ['message' => 'لقد تم تغيير كلمة المرور بنجاح']);
            $this->reset(['newPassword', 'confirmPassword']);
        } catch (\Exception $e) {
            logger()->error($e);
            $this->dispatch('error-message', ['message' => 'حدث خطأ ما، يرجى المحاولة مرة أخرى']);
        }
    }
}
