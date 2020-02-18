<?php

namespace App\Http\Requests\Api\PersonnelManage;

use Dingo\Api\Http\FormRequest;

class StaffManageRequest extends FormRequest
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
        $routeName = $this->route()->getName();
        switch ($routeName) {
            case "api.staff-manage.store":
                $rule = [
                    'staff_name'                => "required",
                    'sex'	                     => "required|integer|in:0,1",
                    'id_number'	                 => "required",
                    'birth_date'                => "required",
                    'subordinate_department'    => "required",
                    'subordinate_team'          => "required",
                    'nation'                    => "required",
                    'position_rank'             => "required",
                    'phone_number'              => "required",
                    'staff_type'                => "required|integer|in:0,1",
                    'start_time'                => "required",
                    'end_time'                  => "required",
                    'staff_status'              => "required|integer|in:0,1",
                    'bank'                      => "required",
                    'bank_card_number'          => "required",
                ];
                break;
            case "":
                $rule = [];
                break;
        };

        return $rule;
    }

    public function messages()
    {
        return [
            'staff_name.required'                => '员工姓名必须',
            'sex.required'	                      => '性别必须',
            'sex.integer'	                      => '性别必须为整数',
            'sex.in'	                          => '性别参数可选0-男，1-女',
            'id_number.required'	              => '身份证号必须',
            'birth_date.required'                => '出生日期必须',
            'subordinate_department.required'    => '所属部门必须',
            'subordinate_team.required'          => '所属团队必须',
            'nation.required'                    => '民族必须',
            'position_rank.required'             => '岗位职级必须',
            'phone_number.required'              => '电话号码必须',
//            'phone_number.mobile'                => '电话号码格式不正确',
            'staff_type.required'                => '员工类型必须',
            'staff_type.integer'	              => '员工类型必须为整数',
            'staff_type.in'	                      => '员工类型参数可选0-劳动合同工 1-临时工',
            'start_time.required'                => '合同起始时间必须',
            'end_time.required'                  => '合同截止时间必须',
            'staff_status.required'              => '员工状态必须',
            'staff_status.integer'	              => '员工状态必须为整数',
            'staff_status.in'	                  => '员工状态参数可选0-在职 1-离职',
            'bank.required'                      => '开户行必须',
            'bank_card_number.required'          => '银行卡号必须',

        ];
    }
}
