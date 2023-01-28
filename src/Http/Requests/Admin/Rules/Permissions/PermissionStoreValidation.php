<?php

namespace Tripteki\Adminer\Http\Requests\Admin\Rules\Permissions;

use Tripteki\Helpers\Http\Requests\FormValidation;

class PermissionStoreValidation extends FormValidation
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

            "permission" => "required|string|max:127|regex:/^[a-zA-Z_\.]+$/|unique:".config("permission.models.permission").",name",
        ];
    }
};
