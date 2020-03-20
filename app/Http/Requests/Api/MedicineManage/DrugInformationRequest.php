<?php


namespace App\Http\Requests\Api\MedicineManage;


use Dingo\Api\Http\FormRequest;

class DrugInformationRequest extends FormRequest
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
            case "api.medicine-manage.drug-information.store":
                $rule = [
                    "drug_name"          => "required",
                    "type"               => "required|integer",
                    "factory"            => "required",
                    "specification"      => "required",
                    "unit"               => "required|integer",
                    "dosage_form"        => "required|integer",
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
            'type.required'               => '类别必须',
            'type.integer'                => '类别必须为整形',
            'factory.required'            => '药厂必须',
            'specification.required'      => '规格必须',
            'unit.required'               => '用药单位必须',
            'unit.integer'                => '用药单位必须为整形',
            'dosage_form.required'        => '剂型必须',
            'dosage_form.integer'         => '剂型必须为整形',
        ];
    }
}