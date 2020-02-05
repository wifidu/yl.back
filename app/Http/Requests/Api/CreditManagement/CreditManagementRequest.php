<?php

namespace App\Http\Requests\Api\CreditManagement;

use Illuminate\Foundation\Http\FormRequest;

class CreditManagementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "business_time" => "required",
            "voucher_no" => "required",
            "member_name" => "required",
            "beds" => "required",
            "payment_type" => "required|integer|in:0,1",
            "amount_receivable" => "required",
            "account_balance" => "required",
            "billing_date" => "required",
            "if_pay" => "required"
        ];
    }

    public function messages()
    {
      return [
          "business_time.required" => "业务时间必须",
          "voucher_no.required" => "账单号必须",
          "member_name.required" => "会员名称必须",
          "beds.required" => "床位必须",
          "payment_type.required" => "收款类型必须",
          "amount_receivable.required" => "应收款必须",
          "account_balance.required" => "账户余额必须",
          "billing_date.required" => "账单时间必须",
          "if_pay.required" => "是否交款必须",
          "payment_type.in" => "0入住收费，1变更收费",
          "payment_type.integer" => "收费类型必须为整数"
        ];
    }
}
