<?php

use App\Model\MemberProfile;
use App\Model\BookBed;
use Illuminate\Database\Seeder;

class BookBedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $member_ids = MemberProfile::all()->pluck('member_ID')->toArray();
        $faker = app(Faker\Generator::class);
        $books = factory(BookBed::class)
            ->times(50)
            ->make()
            ->each(function($book, $index) 
                use ($faker, $member_ids) {
                    $book->elderly_ID = $faker->randomElement($member_ids);
                });
        BookBed::insert($books->toArray());
    }
}
