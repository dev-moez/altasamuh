<?php

namespace App\Filament\Resources\MiscDonationResource\Pages;

use App\Filament\Resources\MiscDonationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMiscDonation extends ViewRecord
{
    protected static string $resource = MiscDonationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
