<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AuthorizationRequest extends FormRequest
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
        return [
            'username' => 'required|string',
            'password' => 'required|string|min:5',
        ];
    }

    public function messages()
    {
        return [
            'username.required'             => '用户名 必须',
            'username.string'               => '用户名 必须为字符串',
            'password.required'             => '密码 必须',
            'username.string'               => '密码 必须为字符串',
            'password.min'                  => '密码 长度最小为5',
        ];
    }
}
