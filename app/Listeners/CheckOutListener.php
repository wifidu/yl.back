<?php

namespace App\Listeners;

use App\Enum\CodeEnum;
use App\Events\CheckOut;
use App\Model\Account;
use App\Model\CheckInManage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckOutListener implements ShouldQueue
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
     * @param  CheckOut  $event
     * @return void
     */
    public function handle(CheckOut $event)
    {
        $params = $event->_checkOut;
        $member_name    = $params['member_name'];
        $expense_item   = $params['expense_item'];
        foreach ($expense_item as $item){
            if ($item['name']==CodeEnum::EXPENSE_ITEM[0]){
                $beds_cost_actual_refund = $item['actual_refund'];
            }elseif ($item['name']==CodeEnum::EXPENSE_ITEM[1]) {
                $meal_cost_actual_refund = $item['actual_refund'];
            }elseif ($item['name']==CodeEnum::EXPENSE_ITEM[2]) {
                $nursing_cost_actual_refund = $item['actual_refund'];
            }elseif ($item['name']==CodeEnum::EXPENSE_ITEM[3]) {
                $other_cost_actual_refund = $item['actual_refund'];
            }elseif ($item['name']==CodeEnum::EXPENSE_ITEM[4]){
                $deposit_actual_refund = $item['actual_refund'];
            }
        }
        if (isset($beds_cost_actual_refund)){
            Account::query()->where(['member_name'=> $member_name])->increment('account_balance',$beds_cost_actual_refund);
        }
        if (isset($meal_cost_actual_refund)){
            Account::query()->where(['member_name'=> $member_name])->increment('account_balance',$meal_cost_actual_refund);
        }
        if (isset($nursing_cost_actual_refund)){
            Account::query()->where(['member_name'=> $member_name])->increment('account_balance',$nursing_cost_actual_refund);
        }
        if (isset($other_cost_actual_refund)){
            Account::query()->where(['member_name'=> $member_name])->increment('account_balance',$other_cost_actual_refund);
        }
        if (isset($deposit_actual_refund)){
            Account::query()->where(['member_name'=> $member_name])->increment('account_balance',$deposit_actual_refund);
        }
    }
}
