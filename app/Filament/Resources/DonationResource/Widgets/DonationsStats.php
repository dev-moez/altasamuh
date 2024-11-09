<?php

namespace App\Filament\Resources\DonationResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Donation;

class DonationsStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(__('messages.Donations count'), Donation::count()),
            Stat::make(__('messages.Donations sum'), number_format(Donation::sum('amount'), 0, ',', ',') . ' د.ك'),
        ];
    }
}
