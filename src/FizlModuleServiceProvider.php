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
        //$this->registerFizl();

        /**
         * Because this is registered AFTER
         * Lexicon we need to force these
         * configurations and bootstrapping
         * on their respective objects.
         */
        /*$this->registerViewComposers();
        $this->registerViewNamespaces();
        $this->registerParsers();
        $this->addViewExtension();

        $this->routeFizlPages();*/
    }

    protected function registerFizl()
    {
        $this->app->register('Anomaly\FizlPages\PagesServiceProvider');
    }

    protected function registerViewComposers()
    {
        $this->app->make('view')->composers(config('fizl-pages::composers', []));
    }

    protected function registerViewNamespaces()
    {
        $this->app->make('view')->addNamespace('fizl', config('fizl-pages::base_path'));
    }

    protected function registerParsers()
    {
        $this->app->make('Anomaly\Lexicon\Parser\ParserResolver')->addParsers(
            config(
                'fizl-pages::extension_parsers',
                [
                    'md' => 'Anomaly\FizlPages\Parser\PageParser',
                ]
            )
        );
    }

    protected function addViewExtension()
    {
        // add the extension
        $this->app->make('view')->addExtension('md', 'lexicon');
    }

    protected function routeFizlPages()
    {
        $pages = app('Anomaly\FizlPages\Pages');

        if ($pages->exists(app('request')->path())) {
            app('router')->any(
                '/{any?}',
                'Anomaly\Streams\Addon\Module\Fizl\Http\Controller\FizlController@map'
            )->where('any', '(.*)');
        }
    }
}
 