<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;
use App\Services\CategoryService;
use App\Settings\GeneralSettings;
use Filament\Tables\Table;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('ar');
        Gate::define('use-translation-manager', function (?User $user) {
            // Your authorization logic
            return $user !== null && $user->hasAnyRole([Role::ROLE_SUPER_ADMIN, Role::ROLE_ADMIN]);
        });

        Gate::before(function ($user, $ability) {
            return $user->hasRole(Role::ROLE_SUPER_ADMIN) ? true : null;
        });

        Table::configureUsing(function (Table $table): void {
            $table
                ->paginationPageOptions([10, 25, 50])
                ->deferLoading()
                ->defaultSort('created_at', 'desc')
                ->poll(null);
        });
    }
}
