<?php

use App\Model\Material;
use Illuminate\Database\Seeder;

class MaterialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Faker\Generator::class);
        $materials = factory(Material::class)
            ->times(20)
            ->make();

        Material::insert($materials->toArray());
    }
}
