<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // TODO.
    }
    
    public function boot(UrlGenerator $url): void
    {
        if (app()->environment('production')) {
            $url->forceScheme('https');
        }
    }
}
