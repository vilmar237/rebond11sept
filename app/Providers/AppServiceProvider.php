<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // On défini le "français" comme langue globale de l'application
        \App::setLocale('fr');

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
