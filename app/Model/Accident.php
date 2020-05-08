<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Accident extends Model
{
    protected $table = "accidents";

    public $timestamps = true;

    protected $fillable = [
        'account_id',
        'type_id',
        'level_accident',
        'occurrence_time',
        'duty_personnel',
        'head',
        'description'
    ];

    public function account()
    {
        return $this->belongsTo('App\Model\Account');
    }

    public function accidentType()
    {
        return $this->belongsTo('App\Model\AccidentType', 'type_id');
    }
}
