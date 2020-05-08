<?php

/*
 * What php team is that is 'one thing, a team, work together'
 */

namespace App\Providers;

use App\Model\Accident;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Accident::observe(\App\Observers\AccidentObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
