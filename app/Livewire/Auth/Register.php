<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Actions\Registration\SendOTPVerificationAction;
use Livewire\Attributes\Computed;
use App\Models\Country;

class Register extends Component
{

    public $name;
    public $phone_number;
    public $password;
    #[Computed('countries')]
    public $countries;
    public $country_code;

    public function mount()
    {
        $this->countries = Country::all();
    }

    protected function rules()
    {
        return [
            'name' => 'required',
            'phone_number' => 'required|numeric|unique:users',
            'password' => 'required|min:8',
            'country_code' => 'required',
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
            'country_code.required' => 'الدولة مطلوبة',
        ];
    }
    public function render()
    {
        return view('livewire.auth.register');
    }

    public function submit()
    {
        $this->validate();
        DB::transaction(function () {
            $user = User::create([
                'name' => $this->name,
                'phone_number' => $this->phone_number,
                'password' => Hash::make($this->password),
                'country_code' => $this->country_code
            ])->assignRole(Role::ROLE_USER);
            (new SendOTPVerificationAction($user))->execute();
            auth()->login($user);
        });
        $this->redirect(route('verify-phone-number'));
    }
}
