<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        \View::composer(
            [
                'users.*',
                'messenger.partials.thread-participants',
                'auth.login',
            ],

            function ($view) {
                $view->with([
                    'users' => \App\User::all(),
                ]);
            }
        );
    }
}
