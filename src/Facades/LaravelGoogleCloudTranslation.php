<?php

namespace NaimKhalifa\LaravelGoogleCloudTranslation\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \NaimKhalifa\LaravelGoogleCloudTranslation\LaravelGoogleCloudTranslation
 */
class LaravelGoogleCloudTranslation extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \NaimKhalifa\LaravelGoogleCloudTranslation\LaravelGoogleCloudTranslation::class;
    }
}
