<?php

namespace NaimKhalifa\GoogleCloudTranslation\Tests;

use NaimKhalifa\GoogleCloudTranslation\GoogleCloudTranslation;

class CommandTestCase extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $mock = $this->getMockBuilder(GoogleCloudTranslation::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mock->method('translate')
            ->willReturn('Une doublure de traduction');

        $mock->method('supportedLanguages')->willReturn(['en', 'fr']);

        $this->app->instance(GoogleCloudTranslation::class, $mock);
    }
}
