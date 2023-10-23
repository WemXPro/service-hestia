<?php

namespace App\Services\Hestia\Providers;

use App\Services\Hestia\HestiaAPI;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class HestiaServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Hestia';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'hestia';

    /**
     * Register config (Config/config.php)
     * 
     * @return bool
     */
    protected $config = false;

    /**
     * Register commands (Console/)
     * 
     * @return bool
     */
    protected $commands = false;

    /**
     * Register migrations (Database/Migrations)
     * 
     * @return bool
     */
    protected $migrations = false;

    /**
     * Register routes (Routes)
     * 
     * @return bool
     */
    protected $routes = true;

    /**
     * Register views (Resources/views)
     * 
     * @return bool
     */
    protected $views = true;

    /**
     * Register language (Resources/lang)
     * 
     * @return bool
     */
    protected $translations = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->config) {
            $this->registerConfig();
        }

        if ($this->views) {
            $this->registerViews();
        }

        if ($this->migrations) {
            $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        }

        if ($this->translations) {
            $this->registerTranslations();
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if ($this->routes) {
            $this->app->register(RouteServiceProvider::class);
        }
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    protected function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    protected function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    /**
     * Retrieve paths where views are published.
     *
     * @return array
     */
    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}