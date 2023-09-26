<?php

namespace NaimKhalifa\LaravelGoogleCloudTranslation;

use NaimKhalifa\LaravelGoogleCloudTranslation\Commands\LaravelGoogleCloudTranslationCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelGoogleCloudTranslationServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-google-cloud-translation')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-google-cloud-translation_table')
            ->hasCommand(LaravelGoogleCloudTranslationCommand::class);
    }
}
