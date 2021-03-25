<?php

use App\Model\BookBed;
use App\Model\CheckOut;
use Illuminate\Database\Seeder;

class CheckOutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $member_name = BookBed::all()->pluck('name')->toArray();
        // $member_ID = BookBed::all()->pluck('y_ID')->toArray();
        $bed = BookBed::all()->pluck('bed_number')->toArray();
        $faker = app(Faker\Generator::class);
        $checkOut = factory(CheckOut::class)
            ->times(50)
            ->make()
            ->each(function($check, $index)
                use($faker, $member_name, $bed) {
                    $check->member_name = $faker->randomElement($member_name);
                    // $check->member_ID = $faker->randomElement($member_ID);
                    $check->bed = $faker->randomElement($bed);
                });
        CheckOut::insert($checkOut->toArray());
    }
}
