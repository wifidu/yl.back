<?php

namespace App\Http\Requests\Api\PersonnelManage;

use Dingo\Api\Http\FormRequest;

class PositionManageRequest extends FormRequest
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
            case "api.position-manage.store":
                $rule = [
                    "position_name"        => "required",
                    "position_type"        => "required|integer|in:0,1,2,3",
                    "position_salary"      => "required",
                    "rank_name"            => "required",
                    "rank_salary"          => "required",
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
            'position_name.required'                 => '岗位名称必须',
            'position_type.required'                 => '岗位类型必须',
            'position_type.integer'                  => '岗位类型必须为整型',
            'position_type.in'                       => '岗位类型参数可选0-行政岗/1-财务岗/2-护理岗/3-管理岗',
            'position_salary.required'               => '岗位薪水必须',
            'rank_name.required'                     => '职级名称必须',
            'rank_salary.required'                   => '职级薪水必须',

        ];
    }
}
