<?php


namespace App\Http\Requests\Api\MemberProfile;


use Dingo\Api\Http\FormRequest;

class MemberProfileRequests extends FormRequest
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
            case "api.member-profile.store":
                $rule = [
                    "member_name" => "required|max:32",
                    "member_ID" => "sometimes|max:24",
                    "gender" => "required|integer|in:0,1",
                    "nation" => "sometimes|max:8",
                    "height" => "required|integer",
                    "weight" => "required|integer",
                    "birth_date" => "sometimes|max:16",
                    "own_system" => "required|max:32",
                    "sign_doctor" => "sometimes|max:32",
                    "community" => "sometimes|max:64",
                    "email" => "sometimes|email",
                    "phone_number" => "required|max:16",
                    "address" => "sometimes|max:128",
                    "domicile" => "sometimes|max:128",
                    "avatar_url" => "sometimes|url"
                ];
                break;
            case "":
                $rule = [];
                break;
            default:
                $rule = [];
        }

        return $rule;
    }

    public function messages()
    {
        return [
            'member_name.required'                 => '会员名称 member_name 必须',
            'member_ID.max'             => '会员身份证号必须有效',
            'gender.required'       => '会员性别 gender 必须',
            'gender.in'                       => '性别参数可选0-男,1-女',
            'gender.integer'                  => '性别参数必须为整数',
            'nation.max'                       => '民族最大范围为 8',
            'height.required'                 => '会员身高 height 必须',
            'height.integer'                  => '会员身高 height 必须是整型',
            'weight.required'                 => '会员体重 weight 必须',
            'weight.integer'                  => '会员体重 weight 必须是整型',
            'birth_date.max'              => '出生日期最大为 16 位',
            'own_system.required'         => '会员所属系统 own_system 必须',
            'sign_doctor.max'             => '签约医生最大为 32 位',
            'community.max'             => '社区最大为 64 位',
            'email.email'             => '邮箱必须为有效邮箱',
            'phone_number.required'          => '会员手机号 phone_number 必须',
            'address.max'           => '地址最多为 128 位',
            'domicile.max'           => '户籍所在地最多为 128 位',
            'avatar_url.url'           => '头像链接必须为有效链接'
        ];
    }

}