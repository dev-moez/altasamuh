<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MiscDonation;
use App\Actions\Cart\AddToCartAction;
use App\Actions\Cart\CheckoutAction;
use App\Livewire\CartComponent;
use App\Models\MiscDonationValue;

class MiscDonationActions extends Component
{
    public $miscDonations;
    public $amount = 0;
    public $misc_donation_id;
    public $quickDonations;
    public $paymentMethodId;
    public function mount()
    {
        $this->miscDonations = MiscDonation::all();
        $this->quickDonations = MiscDonationValue::all();
    }
    public function render()
    {
        return view('livewire.misc-donation-actions');
    }

    public function addToCart()
    {
        $this->resetErrorBag();

        $data = $this->validate([
            'misc_donation_id' => 'required|exists:misc_donations,id',
            'amount' => 'required|numeric|min:1',
        ], [
            'amount.required' => 'يرجى ادخال المبلغ المراد تبرعه',
            'amount.min' => 'يرجى ادخال المبلغ المراد تبرعه لا يقل عن 1',
            'amount.numeric' => 'يرجى ادخال المبلغ المراد تبرعه بطريقة صحيحة',
            'misc_donation_id.required' => 'يرجى اختيار الغرض من التبرع',
        ]);
        $this->dispatch(
            'addToCart',
            cartableType: MiscDonation::class,
            cartableId: $this->misc_donation_id,
            amount: $data['amount'],
        )->to(CartComponent::class);

        $this->reset('amount');
    }
    public function donate()
    {
        $this->resetErrorBag();
        $data = $this->validate([
            'misc_donation_id' => 'required|exists:misc_donations,id',
            'amount' => 'required|numeric|min:1',
            'paymentMethodId' => 'required',
        ], [
            'paymentMethodId.required' => 'يرجى اختيار طريقة الدفع',
            'amount.required' => 'يرجى ادخال المبلغ المراد تبرعه',
            'amount.min' => 'يرجى ادخال المبلغ المراد تبرعه لا يقل عن 1',
            'amount.numeric' => 'يرجى ادخال المبلغ المراد تبرعه بطريقة صحيحة',
            'misc_donation_id.required' => 'يرجى اختيار الغرض من التبرع',
        ]);

        (new AddToCartAction(MiscDonation::class, $this->misc_donation_id, $data['amount']))->execute();
        (new CheckoutAction($this->paymentMethodId))->execute();
    }
}
