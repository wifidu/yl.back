<?php

use App\Model\Material;
use App\Model\MaterialOut;
use Illuminate\Database\Seeder;

class MaterialOutTableSeeder extends Seeder
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
        $materialOuts = factory(MaterialOut::class)
            ->times(20)
            ->make()
            ->each(function ($materialOut, $index)
                use ($faker, $material_ids)
                {
                    $materialOut->material_id = $faker->randomElement($material_ids);
                });
        MaterialOut::insert($materialOuts->toArray());
    }
}
