<?php

use App\Model\BookBed;
use App\Model\OutManage;
use Illuminate\Database\Seeder;

class OutManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $member_name = BookBed::all()->pluck('elderly_name')->toArray();
        $bed = BookBed::all()->pluck('bed_number')->toArray();
        $faker = app(Faker\Generator::class);
        $checkOut = factory(OutManage::class)
        ->times(50)
        ->make()
        ->each(function($check, $index)
            use($faker, $member_name, $bed) {
                $check->member_name = $faker->randomElement($member_name);
                $check->bed_number = $faker->randomElement($bed);
            });
        OutManage::insert($checkOut->toArray());
    }
}
