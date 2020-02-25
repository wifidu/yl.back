<?php

namespace App\Http\Requests\Api\MaterialManagement;

use Dingo\Api\Http\FormRequest;

class MaterialInRequest extends FormRequest
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
            case "api.material.in.store":
                $rule = [
                    "warehouse_name"    => "required",
                    "in_number"         => "required",
                    "origin"            => "required",
                    "batch_number"      => "required",
                    "in_time"           => "required|integer",
                    "operator"          => "required",
                    "in_material"       => "required",
                ];
                break;
            case "api.material.in.delete":
                $rule = [
                    "ids"               => "required",
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
            'warehouse_name.required'        => '仓库名称 必须',
            'in_number.required'             => '入库单号 必须',
            'origin.required'                => '来源 必须',
            'batch_number.required'          => '批号 必须',
            'in_time.required'               => '入库时间 必须',
            'operator.required'              => '操作人 必须',
            'in_material.required'           => '入库清单 必须',
            'ids.required'                   => '删除id 必须',
        ];
    }
}
