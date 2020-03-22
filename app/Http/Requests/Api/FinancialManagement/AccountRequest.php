<?php

namespace App\Http\Requests\Api\FinancialManagement;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'account_number'  => 'required|unique:accounts',
            'member_number'   => 'required|unique:accounts',
            'member_name'     => 'required',
            'beds'            => 'unique:accounts',
//            'account_balance' => 'required',
//            'beds_cost'       => 'required',
//            'meal_cost'       => 'required',
//            'nursing_cost'    => 'required',
//            'other_cost'      => 'required',
//            'cd_card'         => 'required',
        ];
    }

    public function messages()
    {
      return [
            'account_number.unique'    => '账户编号已经存在',
            'member_number.unique'     => '会员编号已经存在',
            'member_name.unique'       => '会员姓名已经存在',
            'beds.unique'              => '床位已被占用',
            'account_number.required'  => '账户编号必须',
            'member_number.required'   => '会员编号必须',
            'member_name.required'     => '会员姓名必须',
            'beds.required'            => '床位必须',
            'account_balance.required' => '账户余额必须',
            'beds_cost.required'       => '床位费必须',
            'meal_cost.required'       => '餐费必须',
            'nursing_cost.required'    => '护理费必须',
            'other_cost.required'      => '其他月度费必须',
            'cd_card.required'         => '身份证必须',
        ];
    }
}
