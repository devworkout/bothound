<?php

namespace DevWorkout\Bothound;

use DevWorkout\Bothound\Console\Commands\Optimize;
use Illuminate\Support\ServiceProvider;

class BothoundServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ( $this->app->runningInConsole() )
        {
            $this->publishes( [
                __DIR__ . '/../config/config.php' => config_path( 'bothound.php' ),
            ], 'config' );

            $this->loadMigrationsFrom( [
                __DIR__ . '/../database/migrations',
            ] );

            $this->commands( Optimize::class );
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom( __DIR__ . '/../config/config.php', 'bothound' );
        $this->app->bind( 'bothound', BothoundClass::class );
    }
}
