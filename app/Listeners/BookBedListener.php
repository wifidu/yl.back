<?php

namespace App\Listeners;

use App\Events\BookBed;
use App\Model\Account;
use App\Model\WaitingCharges;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookBedListener implements ShouldQueue
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
     * @param  BookBed  $event
     * @return void
     */
    public function handle(BookBed $event)
    {
        $params = $event->_bookBed;
        $member_name = $params['name'];
        $data = [
            'deposit'       => $params['appoint_deposit'] ?? 0,
            'cd_card'       => $params['ID'] ?? '',
        ];
        Account::query()->updateOrCreate(['member_name'=> $member_name],$data);

        $data = [
            'deposit'       => $params['appoint_deposit'] ?? 0,
        ];
        WaitingCharges::query()->updateOrCreate(['member_name'=> $member_name],$data);
        WaitingCharges::query()->where(['member_name'=> $member_name])->decrement('total_expenses',$params['appoint_deposit']);
    }
}
