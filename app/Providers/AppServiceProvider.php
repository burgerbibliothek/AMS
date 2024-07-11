<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

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
        /**
         * When running a version of MySQL older than the 5.7.7 release or MariaDB older than the 10.2.2 release the defaultStringLength() is needed.
         * Details: https://laravel.com/docs/10.x/migrations#index-lengths-mysql-mariadb
         */
        Schema::defaultStringLength(191);
        //Model::unguard();
    }
}
