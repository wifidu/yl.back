<?php

namespace App\Http\Requests\Api\FixedAssets;

use Dingo\Api\Http\FormRequest;

class FixedAssetsRequest extends FormRequest
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
            case "api.fixed-assets.store":
                $rule = [
                    "name" => "required",
                    "classification" => "required",
                    "type" => "required|integer|in:0,1,2",
                    "install_date" => "required|integer"
                ];
                break;
            case "":
                $rule = [];
                break;
            default:
                $rule = [];
        };

        return $rule;
    }

    public function messages()
    {
        return [
            'name.required'                 => '资产名称 name 必须',
            'classification.required'       => '分类 classification 必须',
            'type.required'                 => '状态 type 必须',
            'type.integer'                  => '状态 type 必须是整型',
            'type.in'                       => '状态参数可选0-已损坏,1-在用,2-维修中',
            'install_date.required'         => '安装时间 install_date 必须',
            'install_date.integer'          => '安装时间 install_date 必须是整型'
        ];
    }
}
