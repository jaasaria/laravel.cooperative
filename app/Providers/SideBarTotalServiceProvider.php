<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\RefItem;
use App\Models\TrPurchases;
use App\Models\TrSales;
use App\Models\TrStockIn;
use App\Models\TrStockOut;
use App\Models\TrSettings;

class SideBarTotalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        

        // View::share('site_settings', $site_settings);    notes:use this for single 

        view()->composer('back.layouts.admin_sidebar',function($view){

            $countItem =  RefItem::count();
            $countPurchases  =  TrPurchases::count();
            $countSales  =  TrSales::count();
            $countStockIn  =  TrStockIn::count();
            $countStockOut  =  TrStockOut::count();

            $settingWebsite = TrSettings::where('field','Initial Name')->value('value');
            
            $view->with(['countItem'=>$countItem,'countPurchases'=>$countPurchases,'countSales'=>$countSales,'settingWebsite'=>$settingWebsite,'countStockIn'=>$countStockIn,'countStockOut'=>$countStockOut]);

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
