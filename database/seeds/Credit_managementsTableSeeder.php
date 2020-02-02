<?php

use Illuminate\Database\Seeder;
use App\Models\Credit_management;

class Credit_managementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 生成一个财务集合
        $credit = factory(Credit_management::class)
                  ->times(20)
                  ->make();
        credit_management::insert($credit->toArray());
    }
}
