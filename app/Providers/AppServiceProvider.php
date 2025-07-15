<?php

namespace App\Providers;

use App\Models\Kid;
use App\Observers\KidObserver;
use Illuminate\Support\Facades\Gate;
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
    }
}
