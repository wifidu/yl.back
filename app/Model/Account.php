<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = "accounts";

    public $timestamps = true;

    protected $fillable = [
      'account_number',
      'member_number',
      'member_name',
      'beds',
      'account_balance',
      'beds_cost',
      'meal_cost',
      'nursing_cost',
      'other_cost',
      'cd_card',
      'deposit'
    ];

    public function creditManagement()
    {
        return $this->hasMany('App\Model\CreditManagement');
    }

    public function refund()
    {
        return $this->hasMany('App\Model\Refund');
    }

    public function accidents()
    {
        return $this->hasMany('App\Model\Accident');
    }

    public function visits()
    {
        return $this->hasMany('App\Model\Visit', 'member_name', 'member_name');
    }
}
