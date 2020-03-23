<?php

namespace App\Http\Requests\Api\DietManage;

use Dingo\Api\Http\FormRequest;

class RecipesManageRequest extends FormRequest
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
            case "api.recipes-manage.store":
                $rule = [
                    'weekly'	                => "required",
                    'package_name'	            => "required",

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
            'weekly.required'	            =>'周次必须',
            'package_name.required'	            =>'套餐名称必须',

        ];
    }
}
