<?php

use NaimKhalifa\GoogleCloudTranslation\Exceptions\TranslationFailedException;
use NaimKhalifa\GoogleCloudTranslation\Facades\GoogleCloudTranslation;

it('throws an error if the api key is not set', function () {
    config()->set('google-cloud-translation.api_key', null);

    GoogleCloudTranslation::translate('Hello', 'fr');
})->throws(TranslationFailedException::class);

it('can translate text', function () {
    $translation = GoogleCloudTranslation::translate('Hello', 'fr');

    expect($translation)->toBe('Bonjour');
});
