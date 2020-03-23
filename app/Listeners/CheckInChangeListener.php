<?php

namespace App\Listeners;

use App\Events\CheckInChange;
use App\Model\Account;
use App\Model\CheckInManage;
use App\Model\WaitingCharges;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckInChangeListener implements ShouldQueue
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
     * @param  CheckInChange  $event
     * @return void
     */
    public function handle(CheckInChange $event)
    {
        $params = $event->_checkInChange;
        $id = $params['id'];
        $member_name    = CheckInManage::query()->where('id','=',$id)->first();
        $accout_detail  = Account::query()->where(['member_name'=> $member_name['member_name']])->first();
        if ($member_name){
            if (isset($params['bed_cost'])){
                $bed_cost = $params['bed_cost'];
                $data = [
                    'beds'                  => $bed_cost['number'],
                    'beds_cost'             => $bed_cost['cost'],
                    'beds_cost_start_time'  => time(),
                    'account_balance'       => $accout_detail['account_balance']+$accout_detail['beds_cost_left']-$bed_cost['cost'],
                ];
                Account::query()->updateOrCreate(['member_name'=> $member_name['member_name']],$data);

                $data = [
                    'bed_number'            => $bed_cost['number'],
                    'beds_cost'             => $bed_cost['cost'],
                ];
                WaitingCharges::query()->updateOrCreate(['member_name'=> $member_name['member_name']],$data);
            }
            if (isset($params['meal_cost'])){
                $meal_cost = $params['meal_cost'];
                $data = [
                    'meal_cost'         => $meal_cost['cost'],
                    'meal_cost_start_time'  => time(),
                    'account_balance'   => $accout_detail['account_balance']+$accout_detail['meal_cost_left']-$meal_cost['cost'],
                ];
                Account::query()->updateOrCreate(['member_name'=> $member_name['member_name']],$data);

                $data = [
                    'meal_cost'         => $meal_cost['cost'],
                ];
                WaitingCharges::query()->updateOrCreate(['member_name'=> $member_name['member_name']],$data);
            }
        }
    }
}
