<?php

namespace App\Filament\Resources\DonationResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Donation;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Forms\Concerns\InteractsWithForms;

class DonationsStats extends BaseWidget
{
    use InteractsWithPageFilters;

    protected function getStats(): array
    {
        $date_start = $this->filters['date_start'] ?? now()->subWeek();
        $date_end = $this->filters['date_end'] ?? now();
        // $donationsSum = Donation::whereBetween('created_at', [$date_start, $date_end])->sum('amount');
        // $donationsCount = Donation::whereBetween('created_at', [$date_start, $date_end])->count();
        $donationsSum = Donation::sum('amount');
        $donationsCount = Donation::count();
        return [
            Stat::make(__('messages.Donations count'), $donationsCount),
            Stat::make(__('messages.Donations sum'), number_format($donationsSum, 0, ',', ',') . ' د.ك'),
        ];
    }
}
