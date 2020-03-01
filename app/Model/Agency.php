<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $table = "agencies";
    
    public $timestamps = true;

    protected $fillable = [
      'serial_number',
      'business_number',
      'financial_type', // 0 经营收费，1 退费
      'money_flow', // 0 支出， 1收入
      'transaction_amount',
      'payment_channel', // 0现金， 1刷卡， 2转账, 3微信， 4支付宝
      'note'
    ];
}
