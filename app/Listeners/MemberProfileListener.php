<?php

namespace App\Listeners;

use App\Events\MemberProfile;
use App\Model\Account;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MemberProfileListener implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public $_dispatcher;

    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  MemberProfile  $event
     * @return void
     */
    public function handle(MemberProfile $event)
    {
        $params = $event->_memberProfile;
        $data = [
            'account_number'    => $params['id'],
            'member_number'     => $params['id'],
            'member_name'       => $params['member_name']
        ];
        Account::query()->updateOrCreate(['account_number'=> $params['id']],$data);
    }
}
