<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UUIDServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('uuid','App\Services\UUIDGenerator');
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
