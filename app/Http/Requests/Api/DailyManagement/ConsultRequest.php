<?php

/*
 * @author weifan
 * Monday 6th of April 2020 01:20:55 PM
 */

namespace App\Http\Requests\Api\DailyManagement;

use Illuminate\Foundation\Http\FormRequest;

class ConsultRequest extends FormRequest
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
        switch ($this->method()) {
        case 'POST':
            return [
                'time'       => 'required|date_format:Y-m-d H:i:s',
                'consultant' => 'required|string',
                'phone'      => [
                    'required',
                    'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/',
                ],
                'consult_type'     => 'required|in:0,1,2',
                'intention'        => 'required|string',
                'member_name'      => 'required|string',
                'age'              => 'required|numeric',
                'selfcare_ability' => 'required|numeric',
                'note'             => 'required|string',
                'result'           => 'required|string',
            ];

            break;
        case 'PATCH':
            return [
                'id'         => 'numeric',
                'time'       => 'date_format:Y-m-d H:i:s',
                'consultant' => 'string',
                'phone'      => [
                    'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/',
                ],
                'consult_type'     => 'in:0,1,2',
                'intention'        => 'string',
                'member_name'      => 'string',
                'age'              => 'numeric',
                'selfcare_ability' => 'numeric',
                'note'             => 'string',
                'result'           => 'string',
            ];

            break;
        }
    }

    public function messages()
    {
        return [
            'phone.regex'      => '手机号码格式不对',
            'time.date_format' => '时间格式不对，example:2020-01-01 12:03:03(不足10则补0)',
        ];
    }
}
