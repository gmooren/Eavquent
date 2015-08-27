<?php namespace Devio\Propertier;

use Illuminate\Support\ServiceProvider;
use Devio\Propertier\Validators\AbstractValidator;

class PropertierServiceProvider extends ServiceProvider
{
    /**
     * Path to the package configuration file.
     */
    const CONFIG_PATH = __DIR__ . '/../../config/propertier.php';

    /**
     * Botting the service provider.
     */
    public function boot()
    {
        // Will set the service container instance to any validator. This way
        // the full application is accessible from the validators in order
        // to make the validation process flexible and configurable.
        $this->app->resolving(function (AbstractValidator $validator, $app)
        {
            $validator->setContainer($app);
        });

        // Publishes the package configuration file when executing vendor:publish
        $this->publishes([
            static::CONFIG_PATH => config_path('propertier.php'),
        ]);

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
        $this->registerProperties();
    }

    /**
     * Will register the configured properties into the service container.
     */
    protected function registerProperties()
    {
        $this->app->singleton('propertier.properties', function ($app)
        {
            return $app['config']->get('propertier.properties');
        });
    }

    /**
     * Register the package configuration.
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(static::CONFIG_PATH, 'propertier');
    }

}