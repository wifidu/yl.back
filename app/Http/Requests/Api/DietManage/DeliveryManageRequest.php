<?php

namespace App\Http\Requests\Api\DietManage;

use Dingo\Api\Http\FormRequest;

class DeliveryManageRequest extends FormRequest
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
            case "api.delivery-manage.store":
                $rule = [
                    'member_name'	        => "required",
                    'bed_name'	            => "required",
                    'eat_time'             => "required",
                    'meal_times'	        => "required",
                    'dishes_name'          => "required",
                    'dining_style'         => "required",

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
            'member_name.required'	            =>'会员名称必须',
            'bed_name.required'	                =>'床位名称必须',
            'eat_time.required'                =>'就餐时间必须',
            'meal_times.required'              => '餐次名称必须',
            'dishes_name.required'             => '菜品名称必须',
            'dining_style.required'	            =>'就餐方式必须',

        ];
    }
}
