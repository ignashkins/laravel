<?php

namespace App\Providers;

use App\Gearman\GearmanConnector;
use Illuminate\Support\ServiceProvider;

class GearmanServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $manager = $this->app['queue'];

        $manager->addConnector('gearman', function() {
            return new GearmanConnector();
        });
    }
}
