<?php

namespace TituGeorge\PubMed;

use Illuminate\Support\ServiceProvider;

class PubMedServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['pubmed'] = $this->app->share(function($app) {
            return new PubMed;
        });
    }
}
