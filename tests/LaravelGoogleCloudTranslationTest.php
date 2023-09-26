<?php

use NaimKhalifa\LaravelGoogleCloudTranslation\Exceptions\TranslationFailedException;
use NaimKhalifa\LaravelGoogleCloudTranslation\Facades\LaravelGoogleCloudTranslation;

it('throws an error if the api key is not set', function () {
    config()->set('google-cloud-translation.api_key', null);

    LaravelGoogleCloudTranslation::translate('Hello', 'fr');
})->throws(TranslationFailedException::class);

it('can translate text', function () {
    $translation = LaravelGoogleCloudTranslation::translate('Hello', 'fr');

    expect($translation)->toBe('Bonjour');
});
