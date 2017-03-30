<?php

namespace Laraviet\DDDCore;

use Collective\Html\FormFacade;
use Collective\Html\HtmlFacade;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Collective\Html\HtmlServiceProvider;

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
        $this->app->register(HtmlServiceProvider::class);

        AliasLoader::getInstance()->alias("Html", HtmlFacade::class);
        AliasLoader::getInstance()->alias("Form", FormFacade::class);
    }
}