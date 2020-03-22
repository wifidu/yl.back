<?php

namespace App\Listeners;

use App\Events\BookBed;
use App\Model\Account;
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
        $member_name = $params['elderly_name'];
        $data = [
            'deposit'       => $params['appoint_deposit'] ?? 0,
            'cd_card'       => $params['elderly_ID'] ?? '',
        ];
        Account::query()->updateOrCreate(['member_name'=> $member_name],$data);
    }
}
