<?php

namespace App\Providers;

use App\Library\Services\PastelService;
use Illuminate\Support\ServiceProvider;

class PastelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PastelService::class, fn() => new PastelService());
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
