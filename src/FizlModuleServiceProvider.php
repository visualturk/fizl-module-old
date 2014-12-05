<?php namespace Anomaly\Streams\Addon\Module\Fizl;

use Illuminate\Support\ServiceProvider;

class FizlModuleServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('Anomaly\FizlPages\PagesServiceProvider');

        app()->make('Anomaly\FizlPages\Pages');

        // TODO: This is just testing.
    }
}
 