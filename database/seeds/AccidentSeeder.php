<?php

use App\Model\Accident;
use App\Model\AccidentType;
use App\Model\Account;
use Illuminate\Database\Seeder;

class AccidentSeeder extends Seeder
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
        $accidents = factory(Accident::class)
                    ->times(20)
                    ->make()
                    ->each(function ($accident, $index)
                        use ($faker, $account_ids)
                        {
                            $accident->account_id = $faker->randomElement($account_ids);
                        });
        Accident::insert($accidents->toArray());
    }
}
