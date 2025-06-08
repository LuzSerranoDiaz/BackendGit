<?php

namespace App\Providers;

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
/*         Cookie::macro('secureCrossSite', function ($name, $value, $minutes = 0) {
        return Cookie::make($name, $value, $minutes, '/', 'backendbarberiadaw2025.duckdns.org', true, true, false, 'None');
    });
    Cookie::macro('Access-Control-Allow-Origin', function ($name, $value, $minutes = 0) {
        return Cookie::make($name, $value, $minutes, '/', 'backendbarberiadaw2025.duckdns.org', true, true, false, 'None');
    }); */
    }

}
