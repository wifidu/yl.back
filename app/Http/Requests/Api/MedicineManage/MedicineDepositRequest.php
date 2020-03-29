<?php


namespace App\Http\Requests\Api\MedicineManage;


use Dingo\Api\Http\FormRequest;

class MedicineDepositRequest extends FormRequest
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
            case "api.medicine-manage.medicine-deposit.store":
                $rule = [
                    "member_name"            => "required",
                    "bed_number"             => "required",
                    "drug_name"              => "required",
                    "unit"                   => "required|integer",
                    "surplus_medicine"       => "required|integer",
                    "warning_number"         => "required|integer",
                ];
                break;
            case "api.medicine-manage.medicine-deposit.correct":
                $rule = [
                  "id"               => "required",
                  "surplus_medicine" => "required",
                ];
                break;
            case "api.medicine-manage.medicine-deposit.warn":
                $rule = [
                    "id"             => "required",
                    "warning_number" => "required",
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
            'drug_name.required'          => '药品名必须',
            'member_name.required'        => '会员名必须',
            'surplus_medicine.integer'    => '剩余药品必须为整形',
            'surplus_medicine.required'   => '剩余药品必须',
            'bed_number.required'         => '床位必须',
            'unit.required'               => '用药单位必须',
            'unit.integer'                => '用药单位必须为整形',
            'warning_number.required'     => '预警数量必须',
            'warning_number.integer'      => '剂型必须为整形',
            "id.required"                 => 'id 必须',
        ];
    }
}