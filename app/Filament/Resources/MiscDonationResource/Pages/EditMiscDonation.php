<?php

namespace App\Filament\Resources\MiscDonationResource\Pages;

use App\Filament\Resources\MiscDonationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMiscDonation extends EditRecord
{
    protected static string $resource = MiscDonationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
