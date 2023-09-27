<?php

namespace NaimKhalifa\GoogleCloudTranslation\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \NaimKhalifa\GoogleCloudTranslation\GoogleCloudTranslation
 */
class GoogleCloudTranslation extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \NaimKhalifa\GoogleCloudTranslation\GoogleCloudTranslation::class;
    }
}
