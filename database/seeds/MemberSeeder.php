<?php

use App\Model\MemberProfile;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Faker\Generator::class);
        $memberProfiles = factory(MemberProfile::class)
            ->times(50)
            ->make();
        MemberProfile::insert($memberProfiles->toArray());
    }
}
