<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Role;
use App\Models\User;

class Insights extends BaseWidget
{
    protected function getStats(): array
    {
        $usersCount = User::whereHas('roles', function ($query) {
            $query->where('name', Role::ROLE_USER);
        })->count();
        return [
            Stat::make('اجمالي التبرعات في خلال 7 ايام', 10),
            Stat::make('المشاريع الاكثر جمع للتبرعات', 10),
            Stat::make('عدد المستخدمين', $usersCount),
        ];
    }
}
