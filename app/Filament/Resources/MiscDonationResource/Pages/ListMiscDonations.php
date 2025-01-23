<?php

namespace App\Filament\Resources\MiscDonationResource\Pages;

use App\Filament\Resources\MiscDonationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMiscDonations extends ListRecords
{
    protected static string $resource = MiscDonationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
