<?php
/**
 * Created by PhpStorm.
 *
 * Date: 02.08.2019
 * Time: 20:26
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RatesLoaderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('RateLoader','App\Services\RatesLoaders\RateLoaderFabric');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}