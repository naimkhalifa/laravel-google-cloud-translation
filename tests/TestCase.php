<?php

namespace NaimKhalifa\GoogleCloudTranslation\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use NaimKhalifa\GoogleCloudTranslation\GoogleCloudTranslationServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'NaimKhalifa\\GoogleCloudTranslation\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            GoogleCloudTranslationServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
}
