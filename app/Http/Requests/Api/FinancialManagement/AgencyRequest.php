<?php

namespace App\Http\Requests\Api\FinancialManagement;

use Illuminate\Foundation\Http\FormRequest;

class AgencyRequest extends FormRequest
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
            'serial_number'      => 'required',
            'business_number'    => 'required',
            'financial_type'     => 'required',
            'money_flow'         => 'required',
            'transaction_amount' => 'required',
            'payment_channel'    => 'required',
            'note'               => 'required'
        ];
    }

    public function messages()
    {
      return [
            'serial_number.required'      => '流水号必须',
            'business_number.required'    => '业务号必须',
            'financial_type.required'     => '财务类型必须',
            'money_flow.required'         => '资金流向必须',
            'transaction_amount.required' => '交易金额必须',
            'payment_channel.required'    => '支付渠道必须',
            'note.required'               => '备注必须'
        ];
    }
}
