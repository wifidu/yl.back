<?php

namespace App\Listeners;

use App\Events\MaterialIn as MaterialInEvents;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Model\Material as MaterialModel;

class MaterialInListener implements ShouldQueue
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
     * @param  MaterialInEvents  $event
     * @return void
     */
    public function handle(MaterialInEvents $event)
    {
        $params = $event->_materIn;
        $in_material = $params['material_id'];
        MaterialModel::query()->where('id',$in_material)->increment('number',$params['amount']);
    }
}
