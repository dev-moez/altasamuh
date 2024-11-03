<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class Register extends Component
{

    public $name;
    public $phone_number;
    public $password;

    protected function rules()
    {
        return [
            'name' => 'required',
            'phone_number' => 'required|numeric|unique:users',
            'password' => 'required|min:8',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'phone_number.required' => 'رقم الهاتف مطلوب',
            'phone_number.numeric' => 'رقم الهاتف يجب ان يكون رقم',
            'phone_number.unique' => 'رقم الهاتف موجود مسبقا',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور يجب ان تكون اكثر من 8 احرف',
        ];
    }
    public function render()
    {
        return view('livewire.auth.register');
    }

    public function submit()
    {
        $this->validate();
        $user = new User();
        $user->name = $this->name;
        $user->phone_number = $this->phone_number;
        $user->password = Hash::make($this->password);
        $user->save();
        $user->assignRole(Role::ROLE_USER);
        auth()->login($user);
        $this->dispatch('userRegistered');
        $this->redirect(route('home'));
    }
}
