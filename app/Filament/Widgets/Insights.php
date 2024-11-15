<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Role;
use App\Models\User;
use App\Models\Project;
use App\Models\Transaction;
use App\Models\Donation;
use App\Models\Permission;

class Insights extends BaseWidget
{
    protected function getStats(): array
    {
        $usersCount = User::whereHas('roles', function ($query) {
            $query->where('name', Role::ROLE_USER);
        })->count();
        $totalDonationsForProjects = Donation::paid()->sum('amount');
        $topProjects = Project::withSum('donations', 'amount')
            ->having('donations_sum_amount', '>', 0)
            ->orderByDesc('donations_sum_amount')
            ->take(5)
            ->count();
        $donationsCount = Donation::count();
        return [
            Stat::make('اجمالي التبرعات في خلال 7 ايام', $totalDonationsForProjects),
            Stat::make('المشاريع الاكثر جمع للتبرعات', $topProjects),
            Stat::make('عدد المستخدمين', $usersCount),
            Stat::make('عدد عمليات التبرعات', $donationsCount),
        ];
    }

    public static function canView(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['VIEW_INSIGHTS']);
    }
}
