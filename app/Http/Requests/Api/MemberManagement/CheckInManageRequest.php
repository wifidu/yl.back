<?php


namespace App\Http\Requests\Api\MemberManagement;


use Dingo\Api\Http\FormRequest;

class CheckInManageRequest extends FormRequest
{
    /*
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
            case "api.member-manage.check-in.store":
                $rule = [
                    "member_name"       => "required",
                    "care_level"        => "required|integer",
                    "check-in_time"     => "required|integer",
                    "bed_cost"          => "required",
                    "meal_cost"         => "required",
                    "one-time_cost"     => "required"
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
            'member_name.required'       => '姓名必须',
            'care_level.required'        => '照护等级必须',
            'care_level.integer'         => '照护等级必须为整形',
            'check-in_time.integer'      => '入住日期必须为整形',
            'check-in_time.required'     => '入住日期必须',
            'bed_cost.required'          => '床位费必须',
            'meal_cost.required'         => '餐费必须',
            'one-time_cost.required'     => '一次性费用必须',
        ];
    }

}