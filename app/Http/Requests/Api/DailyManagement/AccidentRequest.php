<?php

namespace App\Http\Requests\Api\DailyManagement;

use Illuminate\Foundation\Http\FormRequest;

class AccidentRequest extends FormRequest
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
            'member_name'     => 'required',
            'type'            => 'required',
            'level_accident'  => 'required|in:0,1,2',
            'occurrence_time' => 'required',
            'duty_personnel'  => 'required',
            'head'            => 'required',
            'description'     => 'required'
        ];
    }

    public function messages()
    {
        return [
            'member_name.required'     => '会员名必须',
            'type.required'            => '事故类型必须',
            'level_accident.required'  => '事故等级必须',
            'occurrence_time.required' => '发生时间必须',
            'duty_personnel.required'  => '值班人员必须',
            'head.required'            => '负责人必须',
            'description.required'     => '描述必须',
            'level_accident.in'        => '事故等级必须为０１２'
        ];
    }
}
