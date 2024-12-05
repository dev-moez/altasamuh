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
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Assets\Css;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        FilamentAsset::register([
            Css::make('custom-stylesheet', __DIR__ . '/../../resources/css/filament/admin/theme.css'),
        ]);
    }

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
