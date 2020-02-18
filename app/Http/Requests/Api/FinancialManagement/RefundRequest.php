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
          'business_time' => 'required',  // 业务时间
          'refund_no'     => 'required|unique:refunds',  // 退款单号
          'member_name'   => 'required',  // 会员姓名
          'beds'          => 'required|unique:refunds',  // 床位
          'refund_type'   => 'required',  // 退款类型
          'refund_amount' => 'required',  // 退款金额
          'refund_status' => 'required',  // 退款状态
          'refund_date'   => 'required',  // 退款日期
        ];
    }

    public function messages()
    {
      return [
          'refund_no.unique'       => '退款单号已经存在',
          'beds.unique'            => '床位已经被占用',
          'business_time.required' => '业务时间必须',
          'refund_no.required'     => '退款单号必须',
          'member_name.required'   => '会员姓名必须',
          'beds.required'          => '床位必须',
          'refund_type.required'   => '退款类型必须',
          'refund_amount.required' => '退款金额必须',
          'refund_status.required' => '退款状态必须',
          'refund_date.required'   => '退款日期必须',
        ];
    }
}
