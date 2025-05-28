<?php

declare(strict_types=1);

namespace IBroStudio\CommandPool;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommandPoolServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('laravel-artisan-command-pool');
    }
}
