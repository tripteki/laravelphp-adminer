<?php

namespace Tripteki\Adminer\Http\Requests\Admin\Menus;

use Illuminate\Validation\Rule;
use Tripteki\SettingMenu\Scopes\MenuStrictScope;
use Tripteki\SettingMenu\Models\Admin\Detailmenu;
use Tripteki\Helpers\Http\Requests\FormValidation;
use Illuminate\Support\Str;

class MenuUpdateValidation extends FormValidation
{
    /**
     * @return void
     */
    protected function preValidation()
    {
        return [

            "bar" => $this->route("bar"),
            "menu" => MenuStrictScope::space($this->route("bar").".".$this->route("menu")),
        ];
    }

    /**
     * @return void
     */
    protected function postValidation()
    {
        return [

            "menu" => Str::replaceFirst(MenuStrictScope::space($this->route("bar")."."), "", $this->route("menu")),
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

            "bar" => "required|string|in:headernavbar,sidenavbar",

            "menu" => [

                "required",
                "string",
                "lowercase",
                "max:127",
                Rule::exists(Detailmenu::class, "menuable_id"),
            ],

            "category" => "required|string|max:127",
            "icon" => "required|string|lowercase|max:127|regex:/^[a-z\-]+$/",
            "title" => "required|string|max:127",
            "description" => "required|string|max:65535",
        ];
    }
};
