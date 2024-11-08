<?php

namespace App\Filament\Resources\MiscDonationValueResource\Pages;

use App\Filament\Resources\MiscDonationValueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMiscDonationValues extends ListRecords
{
    protected static string $resource = MiscDonationValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
