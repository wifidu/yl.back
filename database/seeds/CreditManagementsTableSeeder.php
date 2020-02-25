<?php

use App\Model\Account;
use Illuminate\Database\Seeder;
use App\Model\CreditManagement;

class CreditManagementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $account_ids = Account::all()->pluck('id')->toArray();
      $faker = app(Faker\Generator::class); // 获取Faker实例
      $credits = factory(CreditManagement::class)
                ->times(20)
                ->make()
                ->each(function ($credit, $index)
                  use ($account_ids, $faker)
                  {
                      $credit->account_id = $faker->randomElement($account_ids);
                  });
      CreditManagement::insert($credits->toArray());
    }
}
