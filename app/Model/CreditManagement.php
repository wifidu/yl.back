<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CreditManagement extends Model
{
    protected $table = 'credit_managements';

    public $timestamps = false;

    protected $fillable = [
          "id",
          "business_time",
          "voucher_no",
          "member_name",
          "beds",
          "payment_type",
          "amount_receivable",
          "account_balance",
          "billing_date",
          "if_pay",
    ];

    /* public function setBusinessTimeAttribute($value) */
    /* { */
    /*     $this->attributes['business_time'] = strtotime($value); */
    /* } */

    /* public function setBillingDateAttribute($value) */
    /* { */
    /*     $this->attributes['billing_date'] = strtotime($value); */
    /* } */

}
