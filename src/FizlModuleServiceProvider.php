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
        // First setup the config.
        $this->app['config']->set('fizl-pages::home', 'home');
        $this->app['config']->set('fizl-pages::namespaces', ['default']);
        $this->app['config']->set('fizl-pages::extension_parsers', ['md' => 'Anomaly\FizlPages\Parser\PageParser']);

        $this->app['config']->set(
            'fizl-pages::base_path',
            base_path('content') . '/' . app('streams.application')->getReference()
        );

        $this->app['config']->set(
            'fizl-pages::composers',
            ['Anomaly\FizlPages\View\Composer\ConfigViewComposer' => '*']
        );

        // Register the service provider now.
        $this->app->register('Anomaly\FizlPages\PagesServiceProvider');

        $pages = app('\Anomaly\FizlPages\Pages');

        if ($pages->getPage(app('request')->path())) {
            app('router')->any(
                '/{any?}',
                '\Anomaly\Streams\Addon\Module\Fizl\Http\Controller\FizlController@map'
            )->where('any', '(.*)');
        }
    }
}
 