<?php

namespace App\Console\Commands;

use App\Model\MonthlyCharges;
use App\Model\WaitingCharges;
use Illuminate\Console\Command;

class GenerateMonthlyCharges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'p_o:generate-monthly-charges';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成月度报表';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $waiting_charges = WaitingCharges::query()->where('is_ charges','=',1)->get()->toArray();
        foreach ($waiting_charges as $index => $waiting_charge){
            if(!MonthlyCharges::query()->where('waiting_charges_id','=',$waiting_charge['id'])->exists()){
                $id = $waiting_charge['id'];
                $data = array_except($waiting_charges[$index],['id']);
                $data['waiting_charges_id'] = $id;
                MonthlyCharges::query()->create($data);
            }
        }
    }
}
