<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(AccountsSeeder::class);
        $this->call(CreditManagementsTableSeeder::class);
        $this->call(RefundsTableSeeder::class);
        $this->call(AgencySeeder::class);
        $this->call(AccidentSeeder::class);
        $this->call(AccidentTypesSeeder::class);
        $this->call(VisitSeeder::class);
        $this->call(ConsultSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MaterialTableSeeder::class);
        $this->call(MaterialInTableSeeder::class);
        $this->call(MaterialOutTableSeeder::class);
    }
}
