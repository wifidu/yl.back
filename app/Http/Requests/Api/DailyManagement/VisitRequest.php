<?php

/*
 * @author weifan
 * Sunday 29th of March 2020 04:09:28 PM
 */

namespace App\Http\Requests\Api\DailyManagement;

use Illuminate\Foundation\Http\FormRequest;

class VisitRequest extends FormRequest
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
        $name = $this->member_name;

        switch ($this->method()) {
        case 'POST':
            return [
                'visitor'      => 'required|string',
                'phone'        => [
                    'required',
                    'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/',
                ],
                'visit_time'   => 'required|date_format:Y-m-d H:i:s',
                'member_name'  => 'required|string|exists:accounts,member_name',
                'visit_reason' => 'required|string',
                'beds'         => 'required|exists:accounts,beds,member_name,' . $name,
            ];

            break;
        case 'PATCH':
            return [
                'id'           => 'required',
                'visitor'      => 'string',
                'phone'        => [
                    'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/',
                ],
                'visit_time'   => 'date_format:Y-m-d H:i:s',
                'member_name'  => 'string|exists:accounts,member_name',
                'visit_reason' => 'string',
                'beds'         => 'exists:accounts,beds',
            ];

            break;
        default:
            return false;
        }
    }

    public function messages()
    {
        return [
            'member_name.exists'     => '访问对象(姓名)不存在',
            'phone.regex'            => '手机号码格式不对',
            'visit_time.date_format' => '时间格式不对，example:2020-01-01 12:03:03(不足10则补0)',
            'beds.exists'            => '访问床号不存在或没人住（或床号和会员名不对应）',
        ];
    }
}
