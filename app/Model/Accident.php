<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Accident extends Model
{
    protected $table = "accidents";

    public $timestamps = true;

    protected $fillable = [
        'account_id',
        'type',
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
}
