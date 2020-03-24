<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            case "api.user.store":
                $rule = [
                    'username' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_\x7f-\xff]+$/|unique:users,name',
                    'password' => 'required|string|min:5'
                ];
                break;
            case "api.user.update":
                $userId = \Auth::guard('api')->id();
                $rule = [
                    'username'          => 'between:3,25|regex:/^[A-Za-z0-9\-\_\x7f-\xff]+$/|unique:users,name,' .$userId,
                    'avatar_image_id'   => 'exists:images,id,type,avatar,user_id,'.$userId,
                ];
                break;
            case "api.user.delete":
                $rule = [
                    'username' => 'required'
                ];
                break;
            case "api.user.password":
                $rule = [
                    'username' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_\x7f-\xff]+$/|exists:users,name',
//                    'old_password' => 'required|string|min:5',
                    'password' => 'required|string|min:5',
                ];
                break;
            default:
                $rule = [];
        };

        return $rule;
    }

    public function messages()
    {
        return [
            'username.required'             => '用户名 必须',
            'username.between'              => '用户名 长度过短或过长',
            'username.regex'                => '用户名 只支持中文,英文,数字,横杆和下划线',
            'username.exists'               => '用户名 不存在',
            'username.unique'               => '用户名 已存在',
            'password.required'             => '密码 必须',
            'password.min'                  => '密码 长度最小为5',
            'password.string'               => '密码 类型必须为字符串',
        ];
    }
}
