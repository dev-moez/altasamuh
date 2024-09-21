<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
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
    }
}
