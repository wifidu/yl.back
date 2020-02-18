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


        switch($this->method()) {
            case 'POST':
                return [
                    'username' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name',
                    'password' => 'required|string|min:5'
                ];
                break;
            case 'PATCH':
                $userId = \Auth::guard('api')->id();
                return [
                    'username' => 'between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' .$userId,
                    'avatar_image_id' => 'exists:images,id,type,avatar,user_id,'.$userId,
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'username.required'             => '用户名 必须',
            'username.between'              => '用户名 长度过短或过长',
            'name.regex'                    => '用户名 只支持英文,数字,横杆和下划线',
            'username.unique'               => '用户名 已存在',
            'password.required'             => '密码 必须',
            'password.min'                  => '密码 长度最小为5',
        ];
    }
}
