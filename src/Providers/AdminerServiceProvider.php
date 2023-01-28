<?php

namespace Tripteki\Adminer\Providers;

use Tripteki\Adminer\Console\Commands\InstallCommand;
use Illuminate\Support\ServiceProvider;

class AdminerServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    public static $loadRoutes = true;

    /**
     * @return bool
     */
    public static function shouldLoadRoutes()
    {
        return static::$loadRoutes;
    }

    /**
     * @return void
     */
    public static function ignoreRoutes()
    {
        static::$loadRoutes = false;
    }

    /**
     * @return void
     */
    public function boot()
    {
        $this->registerConfigs();
        $this->registerPublishers();
        $this->registerCommands();
        $this->registerRoutes();
    }

    /**
     * @return void
     */
    protected function registerConfigs()
    {
        $this->mergeConfigFrom(__DIR__."/../../config/adminer.php", "adminer");
    }

    /**
     * @return void
     */
    protected function registerCommands()
    {
        if (! $this->app->isProduction() && $this->app->runningInConsole()) {

            $this->commands(
            [
                InstallCommand::class,
            ]);
        }
    }

    /**
     * @return void
     */
    protected function registerRoutes()
    {
        if (static::shouldLoadRoutes()) {

            $this->loadRoutesFrom(__DIR__."/../../routes/admin.php");
            $this->loadRoutesFrom(__DIR__."/../../routes/user.php");
        }
    }

    /**
     * @return void
     */
    protected function registerPublishers()
    {
        $this->publishes(
        [
            __DIR__."/../../config/adminer.php" => config_path("adminer.php"),
        ],

        "tripteki-laravelphp-adminer-configs");

        $this->publishes(
        [
            __DIR__."/../../stubs/tests/Feature/SettingTest.stub" => base_path("tests/Feature/SettingTest.php"),
            __DIR__."/../../stubs/tests/Feature/ProfileTest.stub" => base_path("tests/Feature/ProfileTest.php"),
            __DIR__."/../../stubs/tests/Feature/LocaleTest.stub" => base_path("tests/Feature/LocaleTest.php"),
            __DIR__."/../../stubs/tests/Feature/MenuTest.stub" => base_path("tests/Feature/MenuTest.php"),
            __DIR__."/../../stubs/tests/Feature/RuleTest.stub" => base_path("tests/Feature/RuleTest.php"),
            __DIR__."/../../stubs/tests/Feature/LogTest.stub" => base_path("tests/Feature/LogTest.php"),
            __DIR__."/../../stubs/tests/Feature/NotificationTest.stub" => base_path("tests/Feature/NotificationTest.php"),
        ],

        "tripteki-laravelphp-adminer-tests");
    }
};
