<?php

use App\Model\Material;
use App\Model\MaterialIn;
use Illuminate\Database\Seeder;

class MaterialInTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $material_ids = Material::all()->pluck('id')->toArray();
        $faker = app(Faker\Generator::class);
        $materialIns = factory(MaterialIn::class)
            ->times(20)
            ->make()
            ->each(function ($materialIn, $index)
                use ($faker, $material_ids)
                {
                    $materialIn->material_id = $faker->randomElement($material_ids);
                });
        MaterialIn::insert($materialIns->toArray());
    }
}
