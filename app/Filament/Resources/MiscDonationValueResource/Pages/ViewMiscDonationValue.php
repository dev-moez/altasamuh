<?php

namespace App\Filament\Resources\MiscDonationValueResource\Pages;

use App\Filament\Resources\MiscDonationValueResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMiscDonationValue extends ViewRecord
{
    protected static string $resource = MiscDonationValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
