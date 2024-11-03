<?php

namespace App\Livewire\Projects;

use App\Models\Donation;
use Livewire\Component;
use App\Models\Project;
use MyFatoorah\Library\API\Payment\MyFatoorahPayment;
use App\Models\Transaction;


class ProjectCard extends Component
{
    public $project;
    public $donationsAmount = 0;
    public $requiredDonationValue = 0;
    public $remainingAmount = 0;
    public $donationsPercentage = 0;
    public $amount = 0;
    public $minimumDonationValue;

    public function mount(Project $project)

    {
        $this->project = $project;
        $this->donationsAmount = $project->donations()->sum('amount');
        $this->requiredDonationValue = $project->required_donation_value;
        $this->remainingAmount = $this->requiredDonationValue - $this->donationsAmount;
        $this->donationsPercentage = $this->requiredDonationValue != 0 ? $this->donationsAmount / $this->requiredDonationValue * 100 : 0;
        $this->minimumDonationValue = $this->project->minimum_donation_value;
    }
    public function render()
    {
        return view('livewire.projects.project-card');
    }

    public function donate()
    {
        if (!auth()->check()) {
            $this->dispatch('show-auth-modal', ['detail' => true]);
            return false;
        }
        $this->resetErrorBag();
        $data = $this->validate([
            'amount' => 'required|numeric|min:' . $this->minimumDonationValue . '|max:' . $this->remainingAmount,
        ]);
        $postFields = [
            'NotificationOption' => 'Lnk',
            'InvoiceValue' => $data['amount'],
            'CustomerName' => auth()->user()->name,
            'CustomerMobile' => auth()->user()->phone_number,
        ];

        $orderId = uniqid();
        // dd(config('myfatoorah.api_key'));
        $mfPayment = new MyFatoorahPayment([
            'apiKey' => config('myfatoorah.api_key'),
            'countryCode' => config('myfatoorah.country_iso'),
            'isTest' => config('myfatoorah.test_mode'),
        ]);
        $paymentData = $mfPayment->getInvoiceURL(curlData: $postFields, orderId: $orderId);

        Donation::create([
            'donationable_type' => Project::class,
            'donationable_id' => $this->project->id,
            'user_id' => auth()->id(),
            'amount' => $data['amount']
        ])->create([
            // 'transactionable_type' => Donation::class,
            // 'transactionable_id' => $donation->id,
            'user_id' => auth()->id(),
            'amount' => $data['amount'],
            'invoice_id' => $paymentData['invoiceId'],
            'invoice_url' => $paymentData['invoiceURL'],
            'order_id' => $orderId
        ]);

        return redirect()->to($paymentData['invoiceURL']);
    }
}
