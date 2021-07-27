<?php

namespace Phpsa\LaravelCaseRemapping;

use Illuminate\Support\Collection;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelCaseRemappingServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('laravel-case-remapping');
    }

    public function packageRegistered()
    {
        Collection::mixin(new CollectionMacros());
    }
}
