<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MiscDonation;
use App\Actions\Cart\AddToCartAction;
use App\Actions\Cart\CheckoutAction;
use App\Livewire\CartComponent;

class MiscDonationActions extends Component
{
    public $miscDonations;
    public $amount = 0;
    public $misc_donation_id;
    public function mount()
    {
        $this->miscDonations = MiscDonation::all();
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
        ]);

        (new AddToCartAction(MiscDonation::class, $this->misc_donation_id, $data['amount']))->execute();
        (new CheckoutAction())->execute();
    }
}
