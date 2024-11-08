<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Role;
use App\Models\User;
use App\Models\Project;
use App\Models\Transaction;
use App\Models\Donation;

class Insights extends BaseWidget
{
    protected function getStats(): array
    {
        $usersCount = User::whereHas('roles', function ($query) {
            $query->where('name', Role::ROLE_USER);
        })->count();
        $totalDonationsForProjects = Donation::query()
            ->whereHas('transaction', function ($query) {
                $query->whereNotNull('paid_at');
            })
            ->where('donationable_type', Project::class)
            ->sum('amount');
        $mostDonatedProject = Project::query()
            ->whereHas('donations', function ($query) {
                $query->whereHas('transaction', function ($query) {
                    $query->whereNotNull('paid_at');
                });
            })
            ->withCount('donations')
            ->orderBy('donations_count', 'desc')
            ->count();
        return [
            Stat::make('اجمالي التبرعات في خلال 7 ايام', $totalDonationsForProjects),
            Stat::make('المشاريع الاكثر جمع للتبرعات', $mostDonatedProject),
            Stat::make('عدد المستخدمين', $usersCount),
        ];
    }
}
