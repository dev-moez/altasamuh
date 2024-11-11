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


class ProjectDonationActions extends Component
{
    public $project;
    public $donationsAmount = 0;
    public $requiredDonationValue = 0;
    public $remainingAmount = 0;
    public $donationsPercentage = 0;
    public $amount;
    public $minimumDonationValue;
    public $phone_number;
    public $showPhoneNumber;

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

        if (($this->project->requires_donator_phone_number || $this->showPhoneNumber == true) && auth()->check()) {
            $rules['phone_number'] = 'required';
        }

        $this->resetErrorBag();
        $data = $this->validate($rules);
        $this->dispatch(
            'addToCart',
            cartableType: Project::class,
            cartableId: $this->project->id,
            amount: $data['amount'],
            phoneNumber: $this->phone_number
        )->to(CartComponent::class);

        $this->reset('amount');
    }
    public function donate()
    {
        $this->resetErrorBag();
        $rules = [
            'amount' => 'required|numeric|min:' . $this->minimumDonationValue . '|max:' . $this->remainingAmount,
        ];

        if ($this->project->requires_donator_phone_number && auth()->check()) {
            $rules['phone_number'] = 'required';
        }
        $data = $this->validate($rules);

        (new AddToCartAction(Project::class, $this->project->id, $data['amount'], $this->phone_number))->execute();
        (new CheckoutAction())->execute();
    }
}
