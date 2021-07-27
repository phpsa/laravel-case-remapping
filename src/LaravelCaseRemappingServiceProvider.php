<?php

namespace Phpsa\LaravelCaseRemapping;

use Phpsa\LaravelCaseRemapping\Commands\LaravelCaseRemappingCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelCaseRemappingServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-case-remapping')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-case-remapping_table')
            ->hasCommand(LaravelCaseRemappingCommand::class);
    }
}