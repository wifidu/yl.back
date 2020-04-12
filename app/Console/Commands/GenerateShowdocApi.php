<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateShowdocApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'p_o:generate-showdoc-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成showdoc接口文档';

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
        $system = php_uname('s');
        $showdoc_api_path = config('app.showdoc_api_path');
        if ('Linux'==$system){
            if(!is_executable($showdoc_api_path)){
                $shell = 'chmod +x '.$showdoc_api_path;
                system($shell,$status);
            }

            $shell = $showdoc_api_path;
            system($shell, $status);
            //注意shell命令的执行结果和执行返回的状态值的对应关系
            if ($status) {
                echo "shell命令{$shell}执行失败".PHP_EOL;
            } else {
                echo "shell命令{$shell}成功执行".PHP_EOL;
            }
        }
    }
}
