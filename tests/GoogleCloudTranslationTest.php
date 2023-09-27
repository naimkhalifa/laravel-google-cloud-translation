<?php


use NaimKhalifa\GoogleCloudTranslation\GoogleCloudTranslation;
use NaimKhalifa\GoogleCloudTranslation\TranslateClientProxy;
use NaimKhalifa\GoogleCloudTranslation\Exceptions\GoogleCloudTranslationException;

// Exceptions

beforeEach(function () {
    $this->translateClient = Mockery::mock(TranslateClientProxy::class);
    $this->googleCloudTranslation = new GoogleCloudTranslation($this->translateClient);
});

describe('GoogleCloudTranslation', function () {
    describe('translate', function () {
        it('throws an exception if the api key is not set', function () {
            config()->set('google-cloud-translation.api_key', null);

            $this->googleCloudTranslation->translate('Hello');
        })->throws(GoogleCloudTranslationException::class, 'Missing API key');

        it('throws an exception if the default source language is not set', function () {
            config()->set('google-cloud-translation.default_source_language', null);

            $this->googleCloudTranslation->translate('Hello');
        })->throws(GoogleCloudTranslationException::class, 'Default source language not set');

        it('throws an exception if the default target language is not set', function () {
            config()->set('google-cloud-translation.default_target_language', null);

            $this->googleCloudTranslation->translate('Hello');
        })->throws(GoogleCloudTranslationException::class, 'Default target language not set');

        it('throws an exception if the default source language is invalid', function () {
            config()->set('google-cloud-translation.default_source_language', 'invalid');

            $this->googleCloudTranslation->translate('Hello');
        })->throws(GoogleCloudTranslationException::class, 'Invalid default source language');

        it('throws an exception if the source and target languages are the same', function () {
            config()->set('google-cloud-translation.default_source_language', 'en');
            config()->set('google-cloud-translation.default_target_language', 'en');

            $this->googleCloudTranslation->translate('Hello');
        })->throws(GoogleCloudTranslationException::class, 'Source and target languages cannot be the same');

        it('throws an exception if the input is empty', function () {
            $this->googleCloudTranslation->translate('');
        })->throws(GoogleCloudTranslationException::class, 'Missing input');

        it('can translate text', function () {
            config()->set('google-cloud-translation.default_source_language', 'en');
            config()->set('google-cloud-translation.default_target_language', 'fr');

            $this->translateClient
                ->shouldReceive('translate')
                ->with('Hello', [
                    'source' => 'en',
                    'target' => 'fr',
                    'format' => 'text'
                ])
                ->once()
                ->andReturn([
                    'source' => 'en',
                    'input' => 'Hello',
                    'text' => 'Bonjour',
                ]);

            $translation = $this->googleCloudTranslation->translate('Hello', [
                'target' => 'fr',
            ]);

            expect($translation)->toBe('Bonjour');
        });

        it('uses the default source and target languages if no defaults are provided', function () {
            config()->set('google-cloud-translation.default_source_language', 'fr');
            config()->set('google-cloud-translation.default_target_language', 'es');

            $defaultSource = config('google-cloud-translation.default_source_language');
            $defaultTarget = config('google-cloud-translation.default_target_language');

            $this->translateClient->shouldReceive('translate')
                ->with('Salut', [
                    'source' => $defaultSource,
                    'target' => $defaultTarget,
                    'format' => 'text'
                ])
                ->once()
                ->andReturn([
                    'source' => $defaultSource,
                    'input' => 'Salut',
                    'text' => 'Hola',
                ]);

            $translation = $this->googleCloudTranslation->translate('Salut');

            expect($translation)->toBe('Hola');
        });
    });

    describe('translateBatch', function () {
        it('can batch translate text', function () {
            $this->translateClient
                ->shouldReceive('translateBatch')
                ->with([
                    'Hello',
                    'Goodbye',
                ], [
                    'source' => 'en',
                    'target' => 'fr',
                    'format' => 'text'
                ])
                ->once()
                ->andReturn([
                    [
                        'source' => 'en',
                        'input' => 'Hello',
                        'text' => 'Bonjour',
                    ],
                    [
                        'source' => 'en',
                        'input' => 'Goodbye',
                        'text' => 'Au revoir',
                    ],
                ]);

            $translations = $this->googleCloudTranslation->translateBatch([
                'Hello',
                'Goodbye',
            ], [
                'target' => 'fr',
            ]);

            expect($translations)->toBe([
                [
                    'source' => 'en',
                    'input' => 'Hello',
                    'text' => 'Bonjour',
                ],
                [
                    'source' => 'en',
                    'input' => 'Goodbye',
                    'text' => 'Au revoir',
                ],
            ]);
        });

        it('throws an exception if the input is empty', function () {
            $this->googleCloudTranslation->translateBatch([]);
        })->throws(GoogleCloudTranslationException::class, 'Missing input');
    });
});
