<?php

/*
 * @author weifan
 * Monday 6th of April 2020 10:25:18 AM
 */

use App\Model\Consult;
use Illuminate\Database\Seeder;

class ConsultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* $faker = app(Faker\Generator::class); */
        $consults = factory(Consult::class)
            ->times(20)
            ->make();
        Consult::insert($consults->toArray());
    }
}
