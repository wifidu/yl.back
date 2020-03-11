<?php


namespace App\Http\Requests\Api\MemberManagement;


use Dingo\Api\Http\FormRequest;

class OutManageRequest extends FormRequest
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
            case "api.member-manage.out-manage.store":
                $rule = [
                    "member_name"        => "required",
                    "bed_number"         => "required",
                    "leave_days"         => "required|integer",
                    "out_time"           => "required|integer",
                    "accompany_number"   => "required",
                    "accompany_name"     => "required",
                    "plan_to_return"     => "required|integer",
                    "out_reason"         => "required",
                    "register_person"    => "required",
                    "check-in_time"      => "required|integer",
                    "return_time"        => "required|integer",
                    "actual_leave_days"  => "required|integer",
                    "total"              => "required|numeric",
                    "expense_item"       => "required",
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
            'leave_days.required'         => '会员身份证号必须',
            'leave_days.integer'          => '会员身份证号必须',
            'bed_number.required'         => '床位必须',
            'accompany_number.required'   => '陪同人电话必须',
            'accompany_name.required'     => '陪同人姓名必须',
            'out_time.required'           => '退床日期必须',
            'out_time.integer'            => '退床日期必须为整形',
            'check-out_reason.required'   => '退住原因必须',
            'register_person.required'    => '经办人必须',
            'plan_to_return.required'     => '计划返回时间必须',
            'plan_to_return.integer'      => '计划返回时间必须为整形',
            'out_reason.required'         => '备注必须',
            'expense_item.required'       => '余额必须',
        ];
    }


}