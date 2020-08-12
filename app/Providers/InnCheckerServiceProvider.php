<?php

namespace App\Providers;

use App\Services\InnCheckerFNS;
use Illuminate\Support\ServiceProvider;

class InnCheckerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $this->app->bind('App\Services\Contracts\InnChecker', function ($app) {
            return new InnCheckerFNS();
        });
    }
}
