<?php

namespace Dealskoo\MailList\Providers;

use Dealskoo\Admin\Facades\AdminMenu;
use Dealskoo\Admin\Facades\PermissionManager;
use Dealskoo\Admin\Permission;
use Illuminate\Support\ServiceProvider;

class MailListServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/mail-list.php', 'mail-list');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([

            ]);

            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->publishes([
                __DIR__ . '/../../config/mail-list.php' => config_path('mail-list.php')
            ], 'config');

            $this->publishes([
                __DIR__ . '/../../resources/lang' => resource_path('lang/vendor/mail-list')
            ], 'lang');
        }

        $this->loadRoutesFrom(__DIR__ . '/../../routes/admin.php');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'mail-list');

        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'mail-list');

        AdminMenu::route('admin.mail-lists.index', 'mail-list::mail-list.mail-lists', [], ['icon' => 'uil-envelope-alt', 'permission' => 'mail-lists.index'])->order(9);

        PermissionManager::add(new Permission('mail-lists.index', 'Mail List'));
        PermissionManager::add(new Permission('mail-lists.show', 'View Mail'), 'mail-lists.index');
        PermissionManager::add(new Permission('mail-lists.create', 'Create Mail'), 'mail-lists.index');
        PermissionManager::add(new Permission('mail-lists.edit', 'Edit Mail'), 'mail-lists.index');
        PermissionManager::add(new Permission('mail-lists.destroy', 'Destroy Mail'), 'mail-lists.index');
    }
}
