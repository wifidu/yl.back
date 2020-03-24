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
        'App\Events\MaterialIn' => [
            'App\Listeners\MaterialInListener'
        ],
        'App\Events\MaterialOut' => [
            'App\Listeners\MaterialOutListener'
        ],
        'App\Events\MemberProfile' => [
            'App\Listeners\MemberProfileListener'
        ],
        'App\Events\BookBed' => [
            'App\Listeners\BookBedListener'
        ],
        'App\Events\CheckIn' => [
            'App\Listeners\CheckInListener',
        ],
        'App\Events\CheckInChange' => [
            'App\Listeners\CheckInChangeListener',
        ],
        'App\Events\CheckOut' => [
            'App\Listeners\CheckOutListener',
        ],
        'App\Events\OutManage' => [
            'App\Listeners\OutManageListener',
        ],
        'App\Events\Users' => [
            'App\Listeners\UsersListener',
        ],
        'App\Events\UsersDelete' => [
            'App\Listeners\UsersDeleteListener',
        ],
        'App\Events\ChangeUsersName' => [
            'App\Listeners\ChangeUsersNameListener',
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
