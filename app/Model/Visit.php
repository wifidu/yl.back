<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $table = 'visits';

    public $timestamps = true;

    protected $fillable = [
        'visitor', 'phone', 'visit_time', 'member_name', 'visit_reason', 'beds'
    ];

    public function account()
    {
        return $this->belongsTo('App\Model\Account', 'member_name', 'member_name');
    }
}
