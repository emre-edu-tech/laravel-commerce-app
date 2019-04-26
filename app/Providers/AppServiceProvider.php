<?php

namespace App\Providers;

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

        // Everytime a view is composed, a menu is constructed and hijacked the newly created view
        view()->composer('*', function($view){
            $userMenu = app('App\Http\Controllers\MenuController')->getUserMenu();
            $view->with('userMenu', $userMenu);
        });
    }
}
