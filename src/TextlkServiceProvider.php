<?php

namespace Textlk;

use Illuminate\Support\ServiceProvider;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Mail\MailManager;
use Illuminate\Support\Facades\Notification;
use Config;

class TextLKServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publishing configuration file to config directory
        if (!file_exists(config_path('textlk.php'))) {
            $this->publishes([
                __DIR__.'/config/services.php' => config_path('textlk.php'),
            ], 'config');
        }

        $this->app->make(ChannelManager::class)->extend('textlk', function ($app) {
            return $app->make(TextLKSMSChannel::class);
        });

        $this->app->make(MailManager::class)->extend('textlk', function ($app) {
            return $app->make(TextLKEmailChannel::class);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind the Textlk class to the service container
        // $this->app->bind('textlk', function ($app) {
        //     return new SMS(); // Assuming SMS is your Textlk class, adjust accordingly
        // });

        // Merge the default configuration with the published configuration
        $this->mergeConfigFrom(__DIR__.'/config/textlk.php', 'textlk');
    }
    
}
