<?php

namespace Freyo\MtaH5;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/mta-h5.php', 'services.mta-h5'
        );

        $this->app->singleton('mta-h5', function ($app) {
            return new Application(
                $app['config']['services.mta-h5']
            );
        });
    }

    /**
     * Register the application's event listeners.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
