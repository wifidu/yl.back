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
                    "price" => "required|numeric"
                ];
                break;
            case "api.material.detele":
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
            'price.required'                => '单价 price 必须',
            'price.numeric'                 => '数量 price 必须是数值',
            'ids.required'                  => '删除id 必须',
        ];
    }
}
