<?php

namespace App\Console\Commands;

use App\Model\Material;
use Illuminate\Console\Command;

class CalculateActiveMaterial extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'yake:calculate-active-material';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成活跃材料';

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
    public function handle(Material $material)
    {
        $this->info("开始计算...");

        $material->calculateAndCacheActiveData();

        $this->info("成功生成!");

    }
}
