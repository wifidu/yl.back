<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $table = 'refunds';

    public $timestamps = true;
    
    protected $fillable = [
        'business_time',  // 业务时间
        'refund_no',  // 退款单号
        'refund_type',  // 退款类型
        'refund_amount',  // 退款金额
        'refund_status',  // 退款状态
        'refund_date',  // 退款日期
        'account_id',
        'agent',
        'note',
        'real_refund',
        'deposit',
        'refund_name',
        'spending_way',
    ];

    public function account()
    {
        return $this->belongsTo('App\Model\Account');
    }
}
