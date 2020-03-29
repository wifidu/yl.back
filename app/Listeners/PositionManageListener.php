<?php

namespace App\Listeners;

use App\Model\PositionManage as PositionManageModel;
use App\Events\PositionManage as PositionManageEvent;
use Spatie\Permission\Models\Role;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PositionManageListener implements ShouldQueue
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
     * @param  PositionManage  $event
     * @return void
     */
    public function handle(PositionManageEvent $event)
    {
        $position_name  = $event->_positionManage['position_name'];
        $result         = $this->_role::findOrCreate($position_name,"web");
        \Log::info("添加或更新岗位：".json_encode($result,JSON_UNESCAPED_UNICODE));
        if ($result){
            PositionManageModel::query()->updateOrCreate(['position_name'=>$position_name],['role_id'=>$result->id]);
        }
    }
}
