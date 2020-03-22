<?php

namespace App\Jobs;

use App\Events\WarehouseLog;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MaterialIn implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $_materialIn;

    public function __construct($materialIn)
    {
        $this->_materialIn = $materialIn;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Log::info('队列测试:');
        event(new WarehouseLog($this->_materialIn));
        event(new \App\Events\MaterialIn($this->_materialIn));
    }

    public function fail($exception = null)
    {
        \Log::info('队列失败了');
    }
}
