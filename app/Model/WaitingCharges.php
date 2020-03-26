<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WaitingCharges extends Model
{
    protected $table='waiting_charges';

    public $timestamps = true;

    protected $fillable = [
        'bed_number',               //床位编号
        'member_name',              //姓名
        'charges_time',             //收款时间
        'refund_time',              //退款时间
        'beds_cost',                //床位费
        'nursing_cost',             //护理费
        'risk_insurance',           //抵长护险
        'meal_cost',                //膳食费
        'deposit',                  //押金
        'incidental',               //杂费
        'other_cost',               //一次性收费
        'invoice_number',           //发票号
        'invoice_expenses',         //开票收费
        'total_expenses',           //合计收费
        'mark',                     //备注
        'is_ charges',              //收款状态（0-未收款 1-已收款）
        'member_profile_id',        //会员档案id
    ];
}
