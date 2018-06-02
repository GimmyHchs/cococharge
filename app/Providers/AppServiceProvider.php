<?php

namespace App\Providers;

use Barryvdh\Debugbar\ServiceProvider as DebugBarServiceProvider;
use Illuminate\Support\ServiceProvider;
use URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        URL::forceRootUrl(config('app.url'));
        URL::forceScheme(config('app.scheme'));
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(DebugBarServiceProvider::class);
        }
    }
}
