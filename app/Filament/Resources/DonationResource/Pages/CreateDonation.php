<?php

namespace App\Filament\Resources\DonationResource\Pages;

use App\Filament\Resources\DonationResource;
use App\Models\Project;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use App\Actions\Cart\AddToCartAction;
use App\Actions\Cart\CheckoutAction;
use App\Models\Transaction;
use App\Models\Donation;

class CreateDonation extends CreateRecord
{
    protected static string $resource = DonationResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        return Donation::create([
            'donationable_type' => Project::class,
            'donationable_id' => $data['project_id'],
            'amount' => $data['amount'],
            'phone_number' => $data['phone_number'] ?? null,
            'name' => $data['name'] ?? null,
        ]);
    }
}
