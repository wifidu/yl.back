<?php

namespace App\Listeners;

use App\Events\UsersDelete;
use App\Model\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\Permission\Models\Role;

class UsersDeleteListener implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public $_role;

    public function __construct()
    {
        $this->_role = new Role();
    }

    /**
     * Handle the event.
     *
     * @param  UsersDelete  $event
     * @return void
     */
    public function handle(UsersDelete $event)
    {
        $params = $event->_user;
        $role_name  = $params;
        $this->_role::query()->where(['name'=>$role_name,'guard_name'=>'web'])->delete();
    }
}
