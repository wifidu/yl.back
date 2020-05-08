<?php

use App\Model\Accident;
use App\Model\AccidentType;
use Illuminate\Database\Seeder;

class AccidentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accidentTypes = [
            ['type' => '烧伤'],
            ['type' => '坠楼'],
            ['type' => '车祸'],
            ['type' => '跌倒'],
        ];


        foreach ($accidentTypes as $index => &$accidentType){
            $accidentType['count'] = Accident::where('type_id', $index)->count();
        }

        AccidentType::insert($accidentTypes);

    }
}
