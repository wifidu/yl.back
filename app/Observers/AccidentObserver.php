<?php
namespace App\Observers;

use App\Model\Accident;

class AccidentObserver
{
    /**
     * 监听用户创建的事件。
     *
     * @param  User  $user
     * @return void
     */
    public function created(Accident $accident)
    {
        $accident->accidentType->count = $accident->accidentType->accidents->count();

        $accident->accidentType->save();
    }

    /**
     * 监听用户删除事件。
     *
     * @param  User  $user
     * @return void
     */
    public function deleted(Accident $accident)
    {
        $accident->accidentType->count = $accident->accidentType->accidents->count();

        $accident->accidentType->save();
    }
}
