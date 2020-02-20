<?php

use App\Model\Account;
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
        $account_ids = Account::all()->pluck('id')->toArray();
        $faker = app(Faker\Generator::class);
        $refunds = factory(Refund::class)
                  ->times(20)
                  ->make()
                  ->each(function ($refund, $index)
                    use ($faker, $account_ids)
                  {
                    $refund->account_id = $faker->randomElement($account_ids);
                    if($refund->refund_status == 0){
                      $refund->refund_date = null;
                    }
                  });
        Refund::insert($refunds->toArray());
    }
}
