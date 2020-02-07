<?php

use App\Model\Refund;
use Illuminate\Database\Seeder;

class RefundsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $refunds = factory(Refund::class)
                  ->times(20)
                  ->make()
                  ->each(function ($refund, $index)
                  {
                    if($refund->refund_status == 0){
                      $refund->refund_date = null;
                    }
                  });
        Refund::insert($refunds->toArray());
    }
}
