<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AccidentType extends Model
{
    protected $fillable = [
        'type',
        'count',
    ];

    public $timestamps = false;

    protected $table = "accident_types";

    public function accidents()
    {
        return $this->hasMany('App\Model\Accident', 'type_id');
    }

    public function updateCount()
    {
        $this->count = $this->accidents->count();
        $this->save();
    }
}
