<?php

namespace App\Filament\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use App\Models\Donation;
use Filament\Forms\Components\DatePicker;
use Carbon\Carbon;
use App\Models\Project;
use App\Models\Permission;

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
        // Get dates from date_start to date_end
        $dates = [];
        $startDate = Carbon::parse($this->filterFormData['date_start']);
        $endDate = Carbon::parse($this->filterFormData['date_end']);

        while ($startDate->lte($endDate)) {
            $dates[] = $startDate->format('Y-m-d');
            $startDate->addDay();
        }

        $categories = $dates;
        $series = [];

        // Fetch top 5 projects with most donations overall
        $topProjects = Donation::where('donationable_type', Project::class)
            ->with('donationable') // Load the related project
            ->selectRaw('donationable_id, SUM(amount) as total, donationable_type')
            ->whereBetween('created_at', [$this->filterFormData['date_start'], $this->filterFormData['date_end']])
            ->groupBy('donationable_id', 'donationable_type')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        // Iterate through top projects
        foreach ($topProjects as $project) {
            $projectName = $project->donationable->title; // Assuming Project has a 'name' attribute
            $series[$projectName] = [];

            // Iterate through dates
            foreach ($dates as $date) {
                // Fetch donations for the current project and date
                $donation = Donation::where('donationable_type', Project::class)
                    ->where('donationable_id', $project->donationable_id)
                    ->whereDate('created_at', $date)
                    ->sum('amount');

                $series[$projectName][] = $donation;
            }
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
                ->default(Carbon::now()),
        ];
    }

    public static function canView(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['VIEW_INSIGHTS']);
    }
}
