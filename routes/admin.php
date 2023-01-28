<?php

use Tripteki\Adminer\Http\Controllers\Admin\Setting\SettingAdminController;
use Tripteki\Adminer\Http\Controllers\Admin\Profile\ProfileAdminController;
use Tripteki\Adminer\Http\Controllers\Admin\Locale\LanguageAdminController;
use Tripteki\Adminer\Http\Controllers\Admin\Locale\TranslationAdminController;
use Tripteki\Adminer\Http\Controllers\Admin\Menu\MenuAdminController;
use Tripteki\Adminer\Http\Controllers\Admin\Rule\UserAdminController;
use Tripteki\Adminer\Http\Controllers\Admin\Rule\RoleAdminController;
use Tripteki\Adminer\Http\Controllers\Admin\Rule\PermissionAdminController;
use Tripteki\Adminer\Http\Controllers\Admin\Rule\RuleAdminController;
use Tripteki\Adminer\Http\Controllers\Admin\Log\LogAdminController;
use Tripteki\Adminer\Http\Controllers\Admin\Notification\NotificationAdminController;
use Illuminate\Support\Facades\Route;

Route::prefix(config("adminer.route.admin"))->middleware(config("adminer.middleware.admin"))->group(function () {

    /**
     * Settings.
     */
    Route::apiResource("settings", SettingAdminController::class)->parameters([ "settings" => "key", ]);
    Route::post("settings-import", [ SettingAdminController::class, "import", ]);
    Route::get("settings-export", [ SettingAdminController::class, "export", ]);

    /**
     * Profiles.
     */
    Route::apiResource("profiles", ProfileAdminController::class)->parameters([ "profiles" => "variable", ]);

    /**
     * Locales.
     */
    Route::prefix("locales")->group(function () {

        Route::apiResource("languages", LanguageAdminController::class)->parameters([ "languages" => "code", ]);
        Route::apiResource("languages.translations", TranslationAdminController::class)->parameters([ "languages" => "code", "translations" => "key", ]);
    });

    /**
     * Menus.
     */
    Route::apiResource("bars.menus", MenuAdminController::class)->parameters([ "bars" => "bar", "menus" => "menu", ]);

    /**
     * Rules.
     */
    Route::prefix("rules")->group(function () {

        Route::apiResource("users", UserAdminController::class)->only("show")->parameters([ "users" => "user", ]);
        Route::apiResource("roles", RoleAdminController::class)->except("update")->parameters([ "roles" => "role", ]);
        Route::apiResource("permissions", PermissionAdminController::class)->except("update")->parameters([ "permissions" => "permission", ]);

        Route::put("/{context}/{object}", [ RuleAdminController::class, "rule", ]);
    });

    /**
     * Logs.
     */
    Route::apiResource("logs", LogAdminController::class)->only([ "index", "show", ])->parameters([ "logs" => "log", ]);

    /**
     * Notifications.
     */
    Route::apiResource("notifications", NotificationAdminController::class)->only([ "index", "show", ])->parameters([ "notifications" => "notification", ]);
});
