<?php

namespace App\Listeners;

use App\Events\MaterialOut as MaterialOutEvents;
use App\Model\Material as MaterialModel;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MaterialOutListener implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  MaterialOutEvents  $event
     * @return void
     */
    public function handle(MaterialOutEvents $event)
    {
        $params = $event->_materOut;
        $out_material = $params['out_material'];
        MaterialModel::query()->where('id','=',$out_material['material_id'])->decrement('number',$out_material['number']);
    }
}
