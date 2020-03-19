<?php

/*
 * What php team is that is 'one thing, a team, work together'
 */

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\WarehouseLog' => [
            'App\Listeners\WarehouseLogListener',
        ],
        'App\Events\PositionManage' => [
            'App\Listeners\PositionManageListener',
        ],
        'App\Events\StaffManage' => [
            'App\Listeners\StaffManageListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
