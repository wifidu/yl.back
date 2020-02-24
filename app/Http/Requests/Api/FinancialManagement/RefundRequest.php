<?php

namespace App\Http\Requests\Api\FinancialManagement;

use Illuminate\Foundation\Http\FormRequest;

class RefundRequest extends FormRequest
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
          'business_time'  => 'required',  // 业务时间
          'refund_no'      => 'required|unique:refunds',  // 退款单号
          /* 'member_name' => 'required',  // 会员姓名 */
          'refund_type'    => 'required',  // 退款类型
          'refund_amount'  => 'required',  // 退款金额
          'refund_status'  => 'required',  // 退款状态
          'refund_date'    => 'required',  // 退款日期
          "account_id"     => "required",
          'agent'          => 'required',
          'note'           => 'required',
          'real_refund'    => 'required',
          'deposit'        => 'required',
          'spending_way'   => 'required',
          'refund_name'    => 'required',
        ];
    }

    public function messages()
    {
      return [
          'refund_no.unique'        => '退款单号已经存在',
          'business_time.required'  => '业务时间必须',
          'refund_no.required'      => '退款单号必须',
          /* 'member_name.required' => '会员姓名必须', */
          'refund_type.required'    => '退款类型必须',
          'refund_amount.required'  => '退款金额必须',
          'refund_status.required'  => '退款状态必须',
          'refund_date.required'    => '退款日期必须',
          'account_id.required'     => "会员id必须",
          'agent.required'          => '经办人必须',
          'note.required'           => '备注必须',
          'real_refund.required'    => '真实退款必须',
          'deposit.required'        => '存入账户必须',
          'spending_way.required'   => '支付方式必须',
          'refund_name.required'    => '退款名称必须',
        ];
    }
}
