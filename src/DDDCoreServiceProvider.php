<?php

namespace Laraviet\DDDCore;

use Collective\Html\FormFacade;
use Collective\Html\HtmlFacade;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Collective\Html\HtmlServiceProvider;
use Lavary\Menu\ServiceProvider as LararyMenuServiceProvider;
use Lavary\Menu\Facade as LavaryMenuFacade;

class DDDCoreServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        //Create default menu
        \Menu::make('frontend', function($menu){
          $menu->add('Home');
        });

        view()->share('frontend_menu', \Menu::get('frontend'));

    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(HtmlServiceProvider::class);
        $this->app->register(LararyMenuServiceProvider::class);

        AliasLoader::getInstance()->alias("Html", HtmlFacade::class);
        AliasLoader::getInstance()->alias("Form", FormFacade::class);
        AliasLoader::getInstance()->alias("Menu", LavaryMenuFacade::class);


    }
}