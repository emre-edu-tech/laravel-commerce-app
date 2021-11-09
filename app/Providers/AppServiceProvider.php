<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;    // added while upgrading Laravel 7 to 8
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);

        Paginator::useBootstrap();

        // Everytime a view is composed, a menu is constructed and hijacked the newly created view
        view()->composer('*', function($view){
            $userMenu = app('App\Http\Controllers\MenuController')->getUserMenu();
            $view->with('userMenu', $userMenu);
        });
    }
}
