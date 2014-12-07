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
        app()->register('Anomaly\FizlPages\PagesServiceProvider');

        $pages = app()->make('Anomaly\FizlPages\Pages');
    }
}
 