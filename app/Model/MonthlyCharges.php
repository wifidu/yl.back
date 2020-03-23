<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MonthlyCharges extends Model
{
    protected $table='monthly_charges';

    public $timestamps = true;

    protected $fillable = [
        'waiting_charges_id',       //待收费报表id
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
    ];
}
