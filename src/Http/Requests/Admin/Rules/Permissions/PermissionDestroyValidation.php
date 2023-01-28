<?php

namespace Tripteki\Adminer\Http\Requests\Admin\Rules\Permissions;

use Tripteki\Helpers\Http\Requests\FormValidation;

class PermissionDestroyValidation extends FormValidation
{
    /**
     * @return void
     */
    protected function preValidation()
    {
        return [

            "permission" => $this->route("permission"),
        ];
    }

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

            "permission" => "required|string|exists:".config("permission.models.permission").",name",
        ];
    }
};
