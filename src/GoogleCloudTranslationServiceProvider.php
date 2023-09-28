<?php

namespace NaimKhalifa\GoogleCloudTranslation;

use NaimKhalifa\GoogleCloudTranslation\Commands\TranslateLangFile;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class GoogleCloudTranslationServiceProvider extends PackageServiceProvider
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
            ->hasConfigFile(
                'google-cloud-translation',
            )
            ->hasCommand(TranslateLangFile::class);
    }
}
