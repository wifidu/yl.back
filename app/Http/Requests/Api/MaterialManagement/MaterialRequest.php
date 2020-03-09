<?php

namespace App\Http\Requests\Api\MaterialManagement;

use Dingo\Api\Http\FormRequest;

class MaterialRequest extends FormRequest
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
            case "api.material.store":
                $rule = [
                    "name" => "required",
                    "brand" => "required",
                    "model" => "required",
                    "unit" => "required|integer|in:0,1,2",
                ];
                break;
            case "api.material.delete":
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
            'name.required'                 => '物资名称 name 必须',
            'brand.required'                => '品牌 brand 必须',
            'model.required'                => '型号 model 必须',
            'unit.required'                 => '入库单位 unit 必须',
            'unit.integer'                  => '入库单位 unit 必须是整型',
            'unit.in'                       => '入库单位 可选0-支,1-个,2-包',
            'ids.required'                  => '删除id 必须',
        ];
    }
}
