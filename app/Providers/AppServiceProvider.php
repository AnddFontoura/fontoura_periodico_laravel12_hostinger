<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\Publication;
use Illuminate\Support\Facades\Vite;
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
        Vite::prefetch(concurrency: 3);
        Inertia::share([
            'publications' => function () {
                return Publication::orderBy('name', 'asc')->get();
            },
            'pages' => function () {
                return Page::get();
            }
        ]);
    }
}
