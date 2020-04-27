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
        /* $this->registerPolicies();
        Gate::define('update-status', function ($user, $status) {
            return $user->id == $status->user_id;
        }); */

        if (config('app.env') != 'local') {
            \URL::forceScheme('https');
        }
    }
}
