<?php

namespace App\Listeners;

use App\Events\Users;
use App\Model\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\Permission\Models\Role;

class UsersListener implements ShouldQueue
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
     * @param  Users  $event
     * @return void
     */
    public function handle(Users $event)
    {
        $params     = $event->_users;
        $role_name  = $params['name'];
        $result     = $this->_role::findOrCreate($role_name,"web");
        if ($result){
            User::query()->updateOrCreate(['id'=>$params['id']],['roles_id'=>$result['id']]);
        }
    }
}
