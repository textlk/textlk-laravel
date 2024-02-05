<?php

namespace TextLK;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Notification;

class TextlkServiceProvider extends ServiceProvider
{
    public function boot()
    {
        parent::boot();
    
        // $this->publishes([
        //     __DIR__.'/path-to-config/config.php' => config_path('textlk.php'),
        // ], 'config');

        Notification::extend('textlk', function ($app) {
            return "test";
        });
        // Notification::extend('textlk', function ($app) {
        //     return $app->make(TextlkChannel::class);
        // });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind the TextLK class to the service container
        $this->app->bind('textlk', function ($app) {
            return new TextLK();
        });

        // Merge the default configuration with the published configuration
        $this->mergeConfigFrom(__DIR__.'/path-to-config/config.php', 'textlk');
    }
    
}
