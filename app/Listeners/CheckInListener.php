<?php

namespace App\Listeners;

use App\Events\CheckIn;
use App\Model\Account;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckInListener implements ShouldQueue
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
     * @param  CheckIn  $event
     * @return void
     */
    public function handle(CheckIn $event)
    {
        $params = $event->_checkIn;
        $member_name    = $params['member_name'];
        $bed_cost       = $params['bed_cost'];
        $meal_cost      = $params['meal_cost'];
        $one_time_cost  = $params['one-time_cost'];
        $accout_detail  = Account::query()->where(['member_name'=> $member_name])->first();
        $data = [
            'beds'                  => $bed_cost['number'],
            'beds_cost'             => $bed_cost['cost'],
            'meal_cost'             => $meal_cost['cost'],
            'other_cost'            => $one_time_cost['cost'],
            'account_balance'       => $accout_detail['account_balance']-($bed_cost['cost']+$meal_cost['cost']+$one_time_cost['cost']),
            'beds_cost_start_time'  => time(),
            'meal_cost_start_time'  => time(),
            'other_cost_start_time' => time(),
        ];
        Account::query()->updateOrCreate(['member_name'=> $member_name],$data);
    }
}
