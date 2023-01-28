<?php

use Tripteki\Adminer\Http\Controllers\SettingController;
use Tripteki\Adminer\Http\Controllers\ProfileController;
use Tripteki\Adminer\Http\Controllers\LocaleController;
use Tripteki\Adminer\Http\Controllers\MenuController;
use Tripteki\Adminer\Http\Controllers\LogController;
use Tripteki\Adminer\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::prefix(config("adminer.route.user"))->middleware(config("adminer.middleware.user"))->group(function () {

    /**
     * Settings.
     */
    Route::apiResource("settings", SettingController::class)->only([ "index", "update", "destroy", ])->parameters([ "settings" => "key", ]);

    /**
     * Profiles.
     */
    Route::apiResource("profiles", ProfileController::class)->only([ "index", "update", ])->parameters([ "profiles" => "variable", ]);

    /**
     * Locales.
     */
    Route::get("locales", [ LocaleController::class, "index", ]);
    Route::put("locales", [ LocaleController::class, "update", ]);

    /**
     * Menus.
     */
    Route::get("menus", [ MenuController::class, "index", ]);
    Route::post("menus", [ MenuController::class, "store", ]);
    Route::put("menus", [ MenuController::class, "update", ]);
    Route::delete("menus/{bar}/{menu}", [ MenuController::class, "destroy", ]);

    /**
     * Logs.
     */
    Route::get("logs", [ LogController::class, "index", ]);
    Route::get("logs/{log}", [ LogController::class, "show", ]);
    Route::put("logs/{context}", [ LogController::class, "update", ]);

    /**
     * Notifications.
     */
    Route::get("notifications", [ NotificationController::class, "index", ]);
    Route::put("notifications/{notification?}", [ NotificationController::class, "update", ]);
    Route::delete("notifications/{notification?}", [ NotificationController::class, "destroy", ]);
});
