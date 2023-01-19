<?php

namespace App\Providers;

use App\Services\Geoip\GeoipServiceInterface;
use App\Services\Geoip\MaxmindService;
use App\Services\UserAgent\UserAgentParserService;
use App\Services\UserAgent\BrowserDetectionService;
use App\Services\UserAgent\UserAgentServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GeoipServiceInterface::class, function(){
            return new MaxmindService();
        });
        /*$this->app->singleton(UserAgentServiceInterface::class, function(){
            //return new UserAgentParserService();
            return new BrowserDetectionService();
        });*/
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
