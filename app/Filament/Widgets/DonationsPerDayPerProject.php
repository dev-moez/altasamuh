<?php

namespace App\Filament\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use App\Models\Donation;
use Filament\Forms\Components\DatePicker;
use Carbon\Carbon;
use App\Models\Project;

class DonationsPerDayPerProject extends ApexChartWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'topProjectsPerDay';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Top Projects by Donations per Day';

    protected function getTopProjectsData(): array
    {
        // Fetch donations grouped by project and date, summing the donation amounts
        $donations = Donation::where('donationable_type', Project::class)
            ->with('donationable') // Load the related project
            ->selectRaw('donationable_id, DATE(created_at) as date, SUM(amount) as total, donationable_type')
            ->when($this->filterFormData['date_start'], function ($query) {
                $query->whereDate('created_at', '>=', $this->filterFormData['date_start']);
            })
            ->when($this->filterFormData['date_end'], function ($query) {
                $query->whereDate('created_at', '<=', $this->filterFormData['date_end']);
            })
            ->groupBy('donationable_id', 'date', 'donationable_type')
            ->orderByDesc('total')
            ->get()
            ->take(5)
            ->groupBy('date');

        $categories = [];
        $series = [];

        // Iterate through dates and top projects for each date
        foreach ($donations as $date => $topProjects) {
            $categories[] = $date;

            foreach ($topProjects as $donation) {
                $projectName = $donation->donationable->title; // Assuming Project has a 'name' attribute
                if (!isset($series[$projectName])) {
                    $series[$projectName] = [];
                }
                $series[$projectName][] = $donation->total;
            }
        }

        // Normalize series data to fill missing days with zeroes
        foreach ($series as &$data) {
            $data += array_fill(0, count($categories), 0); // Fill in zeros where data is missing
        }

        return ['categories' => $categories, 'series' => $series];
    }

    /**
     * Chart options (series, labels, types, size, animations...)
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $topProjectsData = $this->getTopProjectsData();
        $seriesFormatted = [];

        // Format series for ApexChart
        foreach ($topProjectsData['series'] as $projectName => $data) {
            $seriesFormatted[] = [
                'name' => $projectName,
                'data' => $data,
            ];
        }

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
                'stacked' => false, // Set to false to display columns side by side
            ],
            'series' => $seriesFormatted,
            'xaxis' => [
                'categories' => $topProjectsData['categories'],
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
            'colors' => ['#f59e0b', '#8a2be2', '#d2691e', '#1e90ff', '#32cd32'],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 3,
                    'horizontal' => false,
                    'columnWidth' => '70%', // Adjusts the width of each column for better spacing
                ],
            ],
            'tooltip' => [
                'shared' => false, // Show individual tooltips for each column when hovered
                'intersect' => true,
            ],
        ];
    }

    protected function getHeading(): ?string
    {
        return 'أفضل المشاريع حسب التبرعات يوميا';
    }

    protected function getFormSchema(): array
    {
        return [
            DatePicker::make('date_start')
                ->label('من تاريخ')
                ->default(Carbon::now()->subWeek()),

            DatePicker::make('date_end')
                ->label('الى تاريخ')
                ->default(Carbon::now()->addDay()),
        ];
    }
}
