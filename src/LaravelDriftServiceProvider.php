<?php

namespace Realpvz\DDDrift;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Realpvz\DDDrift\Console\MakeDomainCommand;

class LaravelDriftServiceProvider extends ServiceProvider
{
    public function register()
    {
        $configPath = __DIR__.'/../config/config.php';

        $this->publishes([
            $configPath => config_path('drift')
        ]);
    }

    public function boot()
    {
        $this->commands([
            MakeDomainCommand::class
        ]);
    }
}