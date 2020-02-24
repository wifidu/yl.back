<?php

namespace App\Http\Requests\Api\MaterialManagement;

use Dingo\Api\Http\FormRequest;

class MaterialOutRequest extends FormRequest
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
            case "api.material.out.store":
                $rule = [
                    "warehouse_name"    => "required",
                    "out_number"        => "required",
                    "whereabouts"       => "required",
                    "user"              => "required",
                    "out_time"          => "required|integer",
                    "operator"          => "required",
                    "out_material"      => "required",
                ];
                break;
            case "api.material.out.delete":
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
            'warehouse_name.required'       => '仓库名称 必须',
            'out_number.required'           => '入库单号 必须',
            'whereabouts.required'          => '去向 必须',
            'user.required'                 => '领用人 必须',
            'out_time.required'             => '出库时间 必须',
            'operator.required'             => '操作人 必须',
            'out_material.required'         => '入库清单 必须',
            'ids.required'                  => '删除id 必须',
        ];
    }
}
