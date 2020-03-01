<?php

use App\Model\Agency;
use Illuminate\Database\Seeder;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agencies = factory(Agency::class)
                    ->times(20)
                    ->make();
        Agency::insert($agencies->toArray());
    }
}
