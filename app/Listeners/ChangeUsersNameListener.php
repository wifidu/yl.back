<?php

namespace App\Listeners;

use App\Events\ChangeUsersName;
use App\Model\User;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\Permission\Models\Role;

class ChangeUsersNameListener implements ShouldQueue
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
     * @param  ChangeUsersName  $event
     * @return void
     */
    public function handle(ChangeUsersName $event)
    {
        $params     = $event->_changeUserName;
        $role_id  = $params['roles_id'];
        $role_name  = $params['name'];
        $result     = $this->_role::findById($role_id,"web");
        if ($result){
            Role::query()->updateOrCreate(['id'=>$result['id']],['name'=>$role_name]);
        }
    }
}
