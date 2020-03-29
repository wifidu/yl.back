<?php

/*
 * @author weifan
 * Sunday 29th of March 2020 01:56:48 PM
 */

use App\Model\Account;
use App\Model\Visit;
use Illuminate\Database\Seeder;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker  = app(Faker\Generator::class);
        $accounts  = Account::all('member_name', 'beds')->toArray();
        $visits = factory(Visit::class)
                ->times(20)
                ->make()
                ->each(function ($visit, $index) use ($faker, $accounts) {
                    $account = $faker->randomElement($accounts);
                    /* dd($account); */
                    $visit->member_name = $account['member_name'];
                    $visit->beds = $account['beds'];
                });
        Visit::insert($visits->toArray());
    }
}
