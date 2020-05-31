<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        if (config('app.debug') === true) {
            \DB::listen(function ($query) {
                \Log::info('Q: ' . $query->sql);
            });
        }

        if (config('app.env') != 'local') {
            \URL::forceScheme('https');
        }
    }
}
