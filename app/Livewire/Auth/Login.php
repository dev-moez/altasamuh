<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class Login extends Component
{
    public $phone_number;
    public $password;
    public function render()
    {
        return view('livewire.auth.login');
    }

    protected function rules()
    {
        return [
            'phone_number' => 'required|numeric',
            'password' => 'required|min:6',
        ];
    }

    protected function messages()
    {
        return [
            'phone_number.required' => 'رقم الهاتف مطلوب',
            'phone_number.numeric' => 'رقم الهاتف يجب ان يكون رقم',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور يجب ان تكون اكثر من 6 احرف',
        ];
    }
    public function submit()
    {
        $this->validate();

        if (auth()->attempt(['phone_number' => $this->phone_number, 'password' => $this->password])) {
            return redirect()->route('home');
        } else {
            session()->flash('error', 'رقم الهاتف أو كلمة المرور غير صحيحة');
        }
    }
}
