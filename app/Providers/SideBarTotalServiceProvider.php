<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\RefItem;
use App\Models\TrPurchases;

class SideBarTotalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        

        // use this for single 
        // View::share('site_settings', $site_settings);

        view()->composer('back.layouts.admin_sidebar',function($view){

            $countItem =  RefItem::count();
            $countPurchases  =  TrPurchases::count();
            
            $view->with(['countItem'=>$countItem,'countPurchases'=>$countPurchases]);

        });




    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
