<?php

namespace Tripteki\Adminer\Http\Requests;

use Tripteki\Helpers\Http\Requests\FormValidation;

class FileImportValidation extends FormValidation
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

            "file" => "required|mimes:csv,txt,xls,xlsx",
        ];
    }
};
