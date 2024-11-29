<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        // Atur guard default untuk admin jika user admin login
        Blade::if('admin', function () {
            return Auth::guard('admin')->check();
        });

        // Atur guard default untuk web/peminjam
        Blade::if('peminjam', function () {
            return Auth::guard('web')->check();
        });
    }
}
