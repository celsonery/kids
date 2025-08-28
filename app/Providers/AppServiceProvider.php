<?php

namespace App\Providers;

use App\Models\Kid;
use App\Models\User;
use App\Observers\KidObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

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
        Kid::observe(KidObserver::class);
        User::observe(UserObserver::class);

        Gate::define('access-imports', function ($user) {
            return $user->hasRole('admin');
        });

        Inertia::share([
            'can' => function () {
                return [
                    'imports' => auth()->check() && Gate::allows('access-imports')
                    ];
            },
        ]);

        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
