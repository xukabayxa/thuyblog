<?php

namespace Vanthao03596\LaravelPackageTools;

use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use ReflectionClass;
use Vanthao03596\LaravelPackageTools\Exceptions\InvalidPackage;

abstract class PackageServiceProvider extends ServiceProvider
{
    protected $package;

    abstract public function configurePackage(Package $package): void;

    public function register()
    {
        $this->registeringPackage();

        $this->package = new Package();

        $this->package->setBasePath($this->getPackageBaseDir());

        $this->configurePackage($this->package);

        if (empty($this->package->name)) {
            throw InvalidPackage::nameIsRequired();
        }

        foreach ($this->package->configFileNames as $configFileName) {
            $this->mergeConfigFrom($this->package->basePath("/../config/{$configFileName}.php"), $configFileName);
        }

        $this->packageRegistered();

        return $this;
    }

    public function boot()
    {
        $this->bootingPackage();

        if ($this->app->runningInConsole()) {
            foreach ($this->package->configFileNames as $configFileName) {
                $this->publishes([
                    $this->package->basePath("/../config/{$configFileName}.php") => config_path("{$configFileName}.php"),
                ], "{$this->package->shortName()}-config");
            }

            if ($this->package->hasViews) {
                $this->publishes([
                    $this->package->basePath('/../resources/views') => base_path("resources/views/vendor/{$this->package->shortName()}"),
                ], "{$this->package->shortName()}-views");
            }

            $now = Carbon::now();
            foreach ($this->package->migrationFileNames as $migrationFileName) {
                if (! $this->migrationFileExists($migrationFileName)) {
                    $this->publishes([
                        $this->package->basePath("/../database/migrations/{$migrationFileName}.php.stub") => with($migrationFileName, function ($migrationFileName) use ($now) {
                            $migrationPath = 'migrations/';

                            if (Str::contains($migrationFileName, '/')) {
                                $migrationPath .= Str::finish(Str::beforeLast($migrationFileName, '/'), '/');
                                $migrationFileName = Str::afterLast($migrationFileName, '/');
                            }

                            return database_path($migrationPath . $now->addSecond()->format('Y_m_d_His') . '_' . Str::finish(Str::snake($migrationFileName), '.php'));
                        }),
                    ], "{$this->package->shortName()}-migrations");
                }
            }

            if ($this->package->hasTranslations) {
                $this->publishes([
                    $this->package->basePath('/../resources/lang') => resource_path("lang/vendor/{$this->package->shortName()}"),
                ], "{$this->package->shortName()}-translations");
            }

            if ($this->package->hasAssets) {
                $this->publishes([
                    $this->package->basePath('/../resources/dist') => public_path("vendor/{$this->package->shortName()}"),
                ], "{$this->package->shortName()}-assets");
            }
        }

        if (! empty($this->package->commands)) {
            $this->commands($this->package->commands);
        }

        if ($this->package->hasTranslations) {
            $this->loadTranslationsFrom(
                $this->package->basePath('/../resources/lang/'),
                $this->package->shortName()
            );

            $this->loadJsonTranslationsFrom($this->package->basePath('/../resources/lang/'));
            $this->loadJsonTranslationsFrom(resource_path('lang/vendor/'. $this->package->shortName()));
        }

        if ($this->package->hasViews) {
            $this->loadViewsFrom($this->package->basePath('/../resources/views'), $this->package->shortName());
        }

        foreach ($this->package->routeFileNames as $routeFileName) {
            $this->loadRoutesFrom("{$this->package->basePath('/../routes/')}{$routeFileName}.php");
        }

        foreach ($this->package->sharedViewData as $name => $value) {
            View::share($name, $value);
        }

        foreach ($this->package->viewComposers as $viewName => $viewComposer) {
            View::composer($viewName, $viewComposer);
        }

        $this->packageBooted();

        return $this;
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $migrationsPath = 'migrations/';

        $len = strlen($migrationFileName) + 4;

        if (Str::contains($migrationFileName, '/')) {
            $migrationsPath .= Str::finish(Str::beforeLast($migrationFileName, '/'), '/');
            $migrationFileName = Str::afterLast($migrationFileName, '/');
        }

        foreach (glob(database_path("${migrationsPath}*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName . '.php')) {
                return true;
            }
        }

        return false;
    }

    public function registeringPackage()
    {
    }

    public function packageRegistered()
    {
    }

    public function bootingPackage()
    {
    }

    public function packageBooted()
    {
    }

    protected function getPackageBaseDir(): string
    {
        $reflector = new ReflectionClass(get_class($this));

        return dirname($reflector->getFileName());
    }
}
