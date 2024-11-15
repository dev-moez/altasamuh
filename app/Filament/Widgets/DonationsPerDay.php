<?php

namespace App\Filament\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use App\Models\Donation;
use Filament\Forms\Components\DatePicker;
use Carbon\Carbon;
use App\Models\Permission;

class DonationsPerDay extends ApexChartWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'donationsPerDay';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'DonationsPerDay';

    protected function getDonationsData(): array
    {
        $donations = Donation::selectRaw('DATE(created_at) as date, SUM(amount) as total')
            ->when($this->filterFormData['date_start'], function ($query) {
                $query->whereDate('created_at', '>=', $this->filterFormData['date_start']);
            })
            ->when($this->filterFormData['date_end'], function ($query) {
                $query->whereDate('created_at', '<=', $this->filterFormData['date_end']);
            })
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $categories = [];
        $data = [];

        foreach ($donations as $donation) {
            $categories[] = $donation->date;
            $data[] = $donation->total;
        }

        return ['categories' => $categories, 'data' => $data];
    }
    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $donationsData = $this->getDonationsData();
        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'DonationsPerDay',
                    'data' => $donationsData['data'],
                ],
            ],
            'xaxis' => [
                'categories' => $donationsData['categories'],
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#f59e0b'],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 3,
                    'horizontal' => false,
                ],
            ],
        ];
    }

    protected function getHeading(): ?string
    {
        return 'التبرعات يوميا';
    }

    protected function getFormSchema(): array
    {
        return [

            // TextInput::make('title')
            //     ->default('My Chart'),

            DatePicker::make('date_start')
                ->label('من تاريخ')
                ->default(Carbon::now()->subWeek()->format('Y-m-d')),

            DatePicker::make('date_end')
                ->label('الى تاريخ')
                ->default(Carbon::now()->format('Y-m-d')),

        ];
    }

    public static function canView(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['VIEW_INSIGHTS']);
    }
}
