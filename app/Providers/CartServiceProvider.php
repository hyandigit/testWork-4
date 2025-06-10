<?php

namespace App\Providers;

use App\Services\Cart\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('cart', function (Application $app) {
            return new Cart();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
