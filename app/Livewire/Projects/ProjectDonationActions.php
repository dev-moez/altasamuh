<?php

namespace App\Livewire\Projects;

use App\Actions\Cart\AddToCartAction;
use App\Actions\Cart\CheckoutAction;
use App\Models\Donation;
use Livewire\Component;
use App\Models\Project;
use App\Models\Transaction;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Livewire\CartComponent;
use App\Models\Country;


class ProjectDonationActions extends Component
{
    public $project;
    public $donationsAmount = 0;
    public $requiredDonationValue = 0;
    public $remainingAmount = 0;
    public $donationsPercentage = 0;
    public $amount = 0;
    public $code;
    public $minimumDonationValue;
    public $phone_number;
    public $showPhoneNumber;
    public $countries;
    public $paymentMethodId;

    public function mount(Project $project, ?bool $showPhoneNumber = false)

    {
        $this->showPhoneNumber = $showPhoneNumber;
        $this->project = $project;
        $this->donationsAmount = $project->donations()
            ->paid()
            ->sum('amount');
        $this->requiredDonationValue = $project->required_donation_value;
        $this->remainingAmount = $this->requiredDonationValue - $this->donationsAmount;
        $this->donationsPercentage = $this->requiredDonationValue != 0 ? $this->donationsAmount / $this->requiredDonationValue * 100 : 0;
        $this->minimumDonationValue = $this->project->minimum_donation_value;
        $this->countries = Country::all();
        $this->code = Country::where('selected_by_default', true)->first()?->code;
    }
    public function render()
    {
        return view('livewire.projects.project-donations-actions');
    }

    public function addToCart()
    {
        $rules = [
            'amount' => 'required|numeric|min:' . $this->minimumDonationValue . '|max:' . $this->remainingAmount,
        ];

        if ($this->project->requires_donator_phone_number && $this->showPhoneNumber == true) {
            $rules['phone_number'] = 'required';
            $rules['code'] = 'required';
        }

        $messages = [
            'paymentMethodId.required' => 'يرجى اختيار طريقة الدفع',
            'amount.required' => 'يرجى ادخال المبلغ المراد تبرعه',
            'amount.numeric' => 'يرجى ادخال المبلغ المراد تبرعه بطريقة صحيحة',
            'amount.min' => 'يرجى ادخال المبلغ المراد تبرعه لا يقل عن ' . $this->minimumDonationValue,
            'amount.max' => 'يرجى ادخال المبلغ المراد تبرعه لا يزيد عن ' . $this->remainingAmount,
            'phone_number.required' => 'يرجى ادخال رقم الهاتف',
            'code.required' => 'يرجى ادخال كود الدولة',
        ];
        $this->resetErrorBag();
        $data = $this->validate($rules, $messages);
        $this->dispatch(
            'addToCart',
            cartableType: Project::class,
            cartableId: $this->project->id,
            amount: $data['amount'],
            phoneNumber: $this->getFullNumber()
        )->to(CartComponent::class);

        $this->reset('amount', 'paymentMethodId', 'phone_number', 'code');
    }
    public function donate()
    {
        $this->resetErrorBag();
        $rules = [
            'amount' => 'required|numeric|min:' . $this->minimumDonationValue . '|max:' . $this->remainingAmount,
            'paymentMethodId' => 'required',
        ];

        $messages = [
            'paymentMethodId.required' => 'يرجى اختيار طريقة الدفع',
            'amount.required' => 'يرجى ادخال المبلغ المراد تبرعه',
            'amount.numeric' => 'يرجى ادخال المبلغ المراد تبرعه بطريقة صحيحة',
            'amount.min' => 'يرجى ادخال المبلغ المراد تبرعه لا يقل عن ' . $this->minimumDonationValue,
            'amount.max' => 'يرجى ادخال المبلغ المراد تبرعه لا يزيد عن ' . $this->remainingAmount,
        ];


        if ($this->project->requires_donator_phone_number && $this->showPhoneNumber == true) {
            $rules['phone_number'] = 'required';
            $rules['code'] = 'required';
        }
        $data = $this->validate($rules, $messages);

        (new AddToCartAction(Project::class, $this->project->id, $data['amount'], $this->phone_number, $this->code))->execute();
        (new CheckoutAction($this->paymentMethodId))->execute();
    }

    private function getFullNumber()
    {
        return $this->code . $this->phone_number;
    }
}
