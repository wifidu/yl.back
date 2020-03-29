<?php

namespace App\Listeners;

use App\Events\StaffManage;
use App\Model\StaffManage as StaffManageModel;
use App\Model\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StaffManageListener implements  ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  StaffManage  $event
     * @return void
     */
    public function handle(StaffManage $event)
    {
        $user_data = $event->_staffManage;
        $user = User::create([
            'name' => $user_data['staff_name'],
            'password' => bcrypt(substr($user_data['id_number'],12,6)),
        ]);
        \Log::info("新增用户：".$user);
        if ($user){
            StaffManageModel::query()->updateOrCreate(['id_number'=>$user_data['id_number']],['user_id'=>$user->id]);
        }
    }
}
