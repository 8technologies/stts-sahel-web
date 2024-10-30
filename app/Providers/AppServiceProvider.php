<?php

namespace App\Providers;
use App\Models\AgroDealers;
use App\Observers\AgroDealerObserver;

use Illuminate\Support\ServiceProvider;

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
        AgroDealers::observe(AgroDealerObserver::class);
    }
}
