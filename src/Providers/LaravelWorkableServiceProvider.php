<?php

namespace Tristanward\LaravelWorkable\Providers;

use Tristanward\LaravelWorkable\LaravelWorkable;
use Illuminate\Support\ServiceProvider;

class LaravelWorkableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('LaravelWorkable', LaravelWorkable::class);

        $this->publishConfigs();
        $this->publishDatabaseFiles();
        $this->publishCommands();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            $this->getConfigsPath(),
            'LaravelWorkable'
        );
    }

    /**
     * Publish configuration file.
     *
     * @return void
     */
    private function publishConfigs()
    {
        $this->publishes([
            $this->getConfigsPath() => config_path('LaravelWorkable.php'),
        ], 'config');
    }

    /**
     * Get local package configuration path.
     *
     * @return string
     */
    private function getConfigsPath()
    {
        return __DIR__.'/../Config/LaravelWorkable.php';
    }

    /**
     * Register and publish database migration.
     *
     * @return void
     */
    private function publishDatabaseFiles()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');

        $this->publishes([
            __DIR__ . '/../Database/migrations' => base_path('database/migrations')
        ], 'migrations');
    }
}
