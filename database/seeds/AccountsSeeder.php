<?php

use App\Model\Account;
use Illuminate\Database\Seeder;

class AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $accounts = factory(Account::class)
                  ->times(20)
                  ->make();
      Account::insert($accounts->toArray());
    }
}
