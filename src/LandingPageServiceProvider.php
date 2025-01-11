<?php

namespace Nozom\LandingPagePackage;

use Illuminate\Support\ServiceProvider;

class LandingPageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        require_once __DIR__."/def.php";
        // Publish migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        // Publish views to the Laravel app's resources/views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'landing-page-package');

         // Publish the config file
        $this->publishes([
            __DIR__ . '/../config/landing-page.php' => config_path('landing-page.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/landing-page-package'),
        ], 'public');
    }
}
