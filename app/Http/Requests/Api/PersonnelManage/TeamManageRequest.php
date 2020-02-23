<?php

namespace App\Http\Requests\Api\PersonnelManage;

use Dingo\Api\Http\FormRequest;

class TeamManageRequest extends FormRequest
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
            case "api.team-manage.store":
                $rule = [
                    'team_name'	                => "required",
                    'service_type'	            => "required",
                    'team_description'         => "required",
                    'team_members'	            => "required",
                    'header'	                => "required",
                    'bed_assignment'	        => "required",

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
            'team_name.required'	            =>'团队名称必须',
            'service_type.required'	            =>'服务类型必须',
            'team_description.required'        =>'工作描述必须',
            'team_members.required'            =>'团队成员必须',
            'header.required'	                =>'负责人必须',
            'bed_assignment.required'	        =>'床位分配必须',

        ];
    }
}
