<?php

namespace Tripteki\Adminer\Providers;

use Tripteki\Adminer\Console\Commands\InstallCommand;
use Illuminate\Support\ServiceProvider;

class AdminerServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    public static $loadConfig = true;

    /**
     * @return bool
     */
    public static function shouldLoadConfig()
    {
        return static::$loadConfig;
    }

    /**
     * @return void
     */
    public static function ignoreConfig()
    {
        static::$loadConfig = false;
    }

    /**
     * @return void
     */
    public function boot()
    {
        $this->registerConfigs();
        $this->registerPublishers();
    }

    /**
     * @return void
     */
    protected function registerConfigs()
    {
        if (static::shouldLoadConfig()) {

            $this->mergeConfigFrom(__DIR__."/../../config/adminer.php", "adminer");
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
    }
};
