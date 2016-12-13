<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\TrSettings;


//please register (config/app)
class ViewAuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('back.layouts.auth',function($view){

            $settingWebsite = TrSettings::where('field','Initial Name')->value('value');
            $settingDesc = TrSettings::where('field','Description')->value('value');
            $view->with(['settingWebsite'=>$settingWebsite,'settingDesc'=>$settingDesc]);

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
