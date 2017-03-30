<?php

namespace Laraviet\DDDCore;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class DDDCoreServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(Collective\Html\HtmlServiceProvider::class);

        AliasLoader::getInstance()->alias("Html", Collective\Html\HtmlFacade::class);
        AliasLoader::getInstance()->alias("Form", Collective\Html\FormFacade::class);
    }
}