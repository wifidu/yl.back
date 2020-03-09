<?php

namespace App\Http\Requests\Api\DietManage;

use Dingo\Api\Http\FormRequest;

class FoodManageRequest extends FormRequest
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
            case "api.food-manage.store":
                $rule = [
                    'food_name'	                => "required",
                    'food_price'	            => "required",
                    'food_type'                => "required|integer|in:0,1",
                    'subordinate_species'	    => "required",

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
            'food_name.required'	            =>'单品名称必须',
            'food_price.required'	            =>'单品价格必须',
            'food_type.required'               =>'单品状态必须',
            'food_type.integer'                => '单品状态必须为整型',
            'food_type.in'                     => '单品状态参数可选 0-下架中/1-上架中',
            'subordinate_species.required'	    =>'所属类别必须',

        ];
    }
}
