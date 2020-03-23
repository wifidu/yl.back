<?php

namespace App\Http\Requests\Api\DietManage;

use Dingo\Api\Http\FormRequest;

class PackageManageRequest extends FormRequest
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
            case "api.package-manage.store":
                $rule = [
                    'package_name'	                   => "required",
                    'package_price'	                   => "required",
                    'package_describe'                => "required",

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
            'package_name.required'	                   =>'套餐名称',
            'package_price.required'	               =>'套餐价格',
            'package_describe.required'               =>'套餐描述',

        ];
    }
}
