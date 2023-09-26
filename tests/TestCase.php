<?php

namespace NaimKhalifa\LaravelGoogleCloudTranslation\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use NaimKhalifa\LaravelGoogleCloudTranslation\LaravelGoogleCloudTranslationServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'NaimKhalifa\\LaravelGoogleCloudTranslation\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelGoogleCloudTranslationServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-google-cloud-translation_table.php.stub';
        $migration->up();
        */
    }
}
