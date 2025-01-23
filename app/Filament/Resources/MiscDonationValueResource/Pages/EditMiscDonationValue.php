<?php

namespace App\Filament\Resources\MiscDonationValueResource\Pages;

use App\Filament\Resources\MiscDonationValueResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMiscDonationValue extends EditRecord
{
    protected static string $resource = MiscDonationValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
