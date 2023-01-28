<?php

namespace Tripteki\Adminer\Http\Requests\Admin\Locales\Language;

use Tripteki\SettingLocale\Models\Admin\Language;
use Tripteki\Helpers\Http\Requests\FormValidation;

class LanguageUpdateValidation extends FormValidation
{
    /**
     * @return void
     */
    protected function preValidation()
    {
        return [

            "code" => $this->route("code"),
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

            "code" => "required|string|lowercase|max:4|regex:/^[a-z_]+$/|exists:".Language::class.",code",
            "locale" => "required|string|max:127|regex:/^[a-z]+-[a-zA-Z]+$/",
        ];
    }
};
