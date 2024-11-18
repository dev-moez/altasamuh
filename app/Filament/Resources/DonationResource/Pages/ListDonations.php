<?php

namespace App\Filament\Resources\DonationResource\Pages;

use App\Filament\Resources\DonationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;

class ListDonations extends ListRecords
{
    use HasFiltersForm;

    protected static string $resource = DonationResource::class;
    public bool $isCachingForms = true;

    public function filtersForm(Form $form): Form
    {
        return $form->schema([
            DatePicker::make('date_start')
                ->default(now()->subMonth()),
            DatePicker::make('date_end')
                ->default(now()),
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getHeaderWidgets(): array
    {
        return [
            DonationResource\Widgets\DonationsStats::class
        ];
    }
}
