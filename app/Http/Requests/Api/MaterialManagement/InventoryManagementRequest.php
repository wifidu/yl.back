<?php

namespace App\Http\Requests\Api\MaterialManagement;

use Dingo\Api\Http\FormRequest;

class InventoryManagementRequest extends FormRequest
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
            case "api.inventory.store":
                $rule = [
                    "id"                => "required",
                    "inventory_losses"  => "required|integer",
                    "inventory_surplus" => "required|integer",
                    "check_person"      => "required"
                ];
                break;
            case "api.inventory.management.delete":
                $rule = [
                    "ids"               => "required",
                ];
                break;
            case "":
                $rule = [];
                break;
        };

        return $rule;
    }

    public function messages()
    {
        return [
            'id.required'                   => '盘点管理主键 必须',
            'inventory_losses.required'     => '盘亏 必须',
            'inventory_losses.integer'      => '盘亏 类型必须为整型',
            'inventory_surplus.required'    => '盘盈 必须',
            'inventory_surplus.integer'     => '盘盈 类型必须为整型',
            'check_person.required'         => '盘点人 必须',
            'ids.required'                  => '删除主键 ids 必须',
        ];
    }
}
