<?php

namespace Hisway\SuningClient;

use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;
use Illuminate\Support\ServiceProvider;

class SuningClientServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__ . '/../config/suning.php');
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('suning.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('suning');
        }
        $this->mergeConfigFrom($source, 'suning');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory($this->app);
        $this->registerManager($this->app);
    }

    /**
     * Register the factory class.
     *
     * @param \Illuminate\Contracts\Foundation\Application | Laravel\Lumen\Application $app
     *
     * @return void
     */
    protected function registerFactory($app)
    {
        $app->singleton('suningclient.factory', function ($app) {
            return new Factories\SuningClientFactory();
        });
        $app->alias('suningclient.factory', 'Hisway\SuningClient\Factories\SuningClientFactory');
    }

    /**
     * Register the manager class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerManager($app)
    {
        $app->singleton('suningclient', function ($app) {
            $config = $app['config'];
            $factory = $app['suningclient.factory'];
            return new SuningClientManager($config, $factory);
        });
        $app->alias('suningclient', 'Hisway\SuningClient\SuningClientManager');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'suningclient',
            'suningclient.factory',
        ];
    }
}