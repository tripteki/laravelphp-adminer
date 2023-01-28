<?php

namespace Tripteki\Adminer\Console\Commands;

use Tripteki\Helpers\Contracts\AuthModelContract;
use Tripteki\Helpers\Helpers\ProjectHelper;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = "adminer:install";

    /**
     * @var string
     */
    protected $description = "Install the stack";

    /**
     * @var \Tripteki\Helpers\Helpers\ProjectHelper
     */
    protected $helper;

    /**
     * @param \Tripteki\Helpers\Helpers\ProjectHelper $helper
     * @return void
     */
    public function __construct(ProjectHelper $helper)
    {
        parent::__construct();

        $this->helper = $helper;
    }

    /**
     * @return int
     */
    public function handle()
    {
        $this->installStack();

        return 0;
    }

    /**
     * @return int|null
     */
    protected function installStack()
    {
        $this->helper->putTrait($this->helper->classToFile(get_class(app(AuthModelContract::class))), \Tripteki\Setting\Traits\SettingTrait::class);
        $this->helper->putTrait($this->helper->classToFile(get_class(app(AuthModelContract::class))), \Tripteki\SettingProfile\Traits\ProfileTrait::class);
        $this->helper->putTrait($this->helper->classToFile(get_class(app(AuthModelContract::class))), \Tripteki\SettingMenu\Traits\MenuTrait::class);
        $this->helper->putTrait($this->helper->classToFile(get_class(app(AuthModelContract::class))), \Tripteki\SettingLocale\Traits\LocaleTrait::class);
        $this->helper->putMiddleware(null, "locale", \Tripteki\SettingLocale\Http\Middleware\TranslationMiddleware::class);
        $this->helper->putTrait($this->helper->classToFile(get_class(app(AuthModelContract::class))), \Tripteki\ACL\Traits\RolePermissionTrait::class);
        $this->helper->putMiddleware(null, "role", \Tripteki\ACL\Http\Middleware\RoleMiddleware::class);
        $this->helper->putMiddleware(null, "permission", \Tripteki\ACL\Http\Middleware\PermissionMiddleware::class);
        $this->helper->putMiddleware(null, "role_or_permission", \Tripteki\ACL\Http\Middleware\RoleOrPermissionMiddleware::class);
        $this->helper->putTrait($this->helper->classToFile(get_class(app(AuthModelContract::class))), \Tripteki\Log\Traits\LogCauseTrait::class);
    }
};
