<?php

namespace Tripteki\Adminer\Http\Requests\Admin\Rules\Roles;

use Tripteki\Helpers\Http\Requests\FormValidation;

class RoleStoreValidation extends FormValidation
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            "role" => "required|string|max:127|regex:/^[a-zA-Z_\.]+$/|unique:".config("permission.models.role").",name",
        ];
    }
};
