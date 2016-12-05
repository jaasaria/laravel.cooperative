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
