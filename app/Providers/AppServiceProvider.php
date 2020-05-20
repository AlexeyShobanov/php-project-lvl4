<?php

namespace App\Providers;

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
