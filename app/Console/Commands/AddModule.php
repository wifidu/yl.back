<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Contracts\Permission;
use Log;

class AddModule extends Command
{
    protected $signature = 'p_o:add-module';

    protected $description = '将所有模块注册到数据库';

    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $module = config('module');
        $module_names = array_keys($module);

        foreach ($module_names as $module_name)
        {
            /**
             * @var $permission Permission
             */
            $permission = app()->make(Permission::class);
            $permission::findOrCreate($module_name,'web');
            Log::info('向数据库添加模块：'.$module_name);
        }
    }
}
