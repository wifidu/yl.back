<?php


namespace App\Http\Requests\Api\MemberManagement;


use Dingo\Api\Http\FormRequest;

class CheckOutRequest extends FormRequest
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
            case "api.member-manage.check-out.store":
                $rule = [
                    "member_name"        => "required",
                    "member_ID"          => "required",
                    "bed"                => "required",
                    "check-out_time"     => "required|integer",
                    "check-out_reason"   => "required",
                    "manager"            => "required",
                    "manage_time"        => "required|integer",
                    "remark"             => "required",
                    "account_balance"    => "required",
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
            'member_name.required'        => '会员名必须',
            'member_ID.required'          => '会员身份证号必须',
            'bed.required'                => '床位必须',
            'check-out_time.required'     => '退床日期必须',
            'check-out_time.integer'      => '退床日期必须为整形',
            'check-out_reason.required'   => '退住原因必须',
            'manager.required'            => '经办人必须',
            'manage_time.required'        => '老经办时间必须',
            'manage_time.integer'         => '老人姓名必须',
            'remark.required'             => '备注必须',
            'account_balance.required'    => '余额必须',
        ];
    }

}