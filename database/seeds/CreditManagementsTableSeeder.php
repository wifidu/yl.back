<?php

use Illuminate\Database\Seeder;
use App\Models\CreditManagement;

class CreditManagementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $credit = factory(CreditManagement::class)
                ->times(20)
                ->make();
      CreditManagement::insert($credit->toArray());
    }
}
