<?php

namespace App\Http\Requests\Api\PersonnelManage;

use Dingo\Api\Http\FormRequest;

class DepartmentManageRequest extends FormRequest
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
            case "api.department-manage.store":
                $rule = [
                    "department_name"        => "required",
                    "department_description" => "required",
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
            'department_name.required'                 => '部门名称必须',
            'department_description.required'          => '部门描述必须',
        ];
    }
}
