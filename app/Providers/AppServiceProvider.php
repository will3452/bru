<?php

namespace App\Providers;

use App\Script;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Blade::directive('copyright_disclaimer', function () {
            return 'I certify that I own the copyright and have obtained written approval for use of all the materials under my name and account, and hold BRUMULTIVERSE free of liabilities should any copyright infringement occurs.';
        });
    }
}
