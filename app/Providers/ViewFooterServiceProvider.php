<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\TrSettings;

class ViewFooterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
          view()->composer('back.layouts.admin_footer',function($view){

            $settingWebsite = TrSettings::where('field','Website Name')->value('value');
            $settingCopyRight = TrSettings::where('field','Copyright')->value('value');
            $view->with(['settingWebsite'=>$settingWebsite,'settingCopyRight'=>$settingCopyRight]);

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
