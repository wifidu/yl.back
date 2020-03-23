<?php


namespace App\Http\Requests\Api\MemberManagement;


use Dingo\Api\Http\FormRequest;

class DeathRegistrationRequests extends FormRequest
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
            case "api.member-manage.death-registration.store":
                $rule = [
                    "member_name"                 => "required",
                    "member_ID"                   => "required",
                    "death_time"                  => "required|integer",
                    "certificate_time"            => "required|integer",
                    "family_address"              => "required",
                    "contact_number"              => "required",
                    "check-in_main_diagnosis"     => "required",
                    "death_disease"               => "required",
                    "certificate_doctor"          => "required",
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


}