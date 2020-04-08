<?php

/*
 * @author weifan
 * Monday 6th of April 2020 10:14:04 AM
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Consult extends Model
{
    protected $table = 'consults';

    public $fillable = [
        'time',
        'consultant',
        'phone',
        'consult_type',
        'intention',
        'member_name',
        'age',
        'selfcare_ability',
        'note',
        'result',
    ];
}
