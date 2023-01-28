<?php

namespace Tripteki\Adminer\Http\Requests\Admin\Locales\Language;

use Tripteki\SettingLocale\Models\Admin\Language;
use Tripteki\Helpers\Http\Requests\FormValidation;

class LanguageStoreValidation extends FormValidation
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

            "code" => "required|string|lowercase|max:4|regex:/^[a-z_]+$/|unique:".Language::class.",code",
            "locale" => "required|string|max:127|regex:/^[a-z]+-[a-zA-Z]+$/",
        ];
    }
};
