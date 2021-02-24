<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PaytmVidoUploadService;

class PaytmVideoUploadServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind('App\Services\PaytmVidoUploadService');
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
