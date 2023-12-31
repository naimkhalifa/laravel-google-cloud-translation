<?php

namespace NaimKhalifa\GoogleCloudTranslation;

use NaimKhalifa\GoogleCloudTranslation\Enums\GoogleCloudTranslationExceptionType;
use NaimKhalifa\GoogleCloudTranslation\Exceptions\GoogleCloudTranslationException;
use NaimKhalifa\GoogleCloudTranslation\Traits\SupportedLanguages;

class GoogleCloudTranslation
{
    use SupportedLanguages;

    protected TranslateClientProxy $translateClient;

    public function __construct(TranslateClientProxy $translateClient)
    {
        $this->translateClient = $translateClient;
    }

    protected function validateConfig(): void
    {
        if (! config('google-cloud-translation.api_key')) {
            throw new GoogleCloudTranslationException(GoogleCloudTranslationExceptionType::MissingApiKey);
        }

        if (! config('google-cloud-translation.default_source_language')) {
            throw new GoogleCloudTranslationException(GoogleCloudTranslationExceptionType::MissingDefaultSourceLanguage);
        }

        if (! config('google-cloud-translation.default_target_language')) {
            throw new GoogleCloudTranslationException(GoogleCloudTranslationExceptionType::MissingDefaultTargetLanguage);
        }

        if (! in_array(config('google-cloud-translation.default_source_language'), $this->supportedLanguages())) {
            throw new GoogleCloudTranslationException(GoogleCloudTranslationExceptionType::InvalidDefaultSourceLanguage);
        }

        if (config('google-cloud-translation.default_source_language') === config('google-cloud-translation.default_target_language')) {
            throw new GoogleCloudTranslationException(GoogleCloudTranslationExceptionType::SameSourceAndTargetLanguages);
        }
    }

    /**
     * @param  array<string,string>  $options
     */
    public function translate(string $text, array $options = []): string|GoogleCloudTranslationException
    {
        $this->validateConfig();

        if (empty($text)) {
            throw new GoogleCloudTranslationException(GoogleCloudTranslationExceptionType::MissingInput);
        }

        $hydratedOptions = $this->hydrateTranslateOptions($options);

        $translation = $this->translateClient->translate($text, $hydratedOptions);

        if (! isset($translation['text'])) {
            throw new GoogleCloudTranslationException(GoogleCloudTranslationExceptionType::TranslationFailed);
        }

        return $translation['text'];
    }

    /**
     * @param  array<string,string>  $options
     * @param  array<string,string>  $input
     * @return array<array<string,string>>
     */
    public function translateBatch(array $input = [], array $options = []): array
    {
        $this->validateConfig();

        if (count($input) === 0) {
            throw new GoogleCloudTranslationException(GoogleCloudTranslationExceptionType::MissingInput);
        }

        $hydratedOptions = $this->hydrateTranslateOptions($options);

        return $this->translateClient->translateBatch($input, $hydratedOptions);
    }

    /**
     * @param  array<string,string>  $options
     * @return array<string,string>
     */
    protected function hydrateTranslateOptions(array $options): array
    {
        $targetLanguage = $options['target'] ?? config('google-cloud-translation.default_target_language');
        $sourceLanguage = $options['source'] ?? config('google-cloud-translation.default_source_language');
        $format = $options['format'] ?? config('google-cloud-translation.default_format');

        return [
            'target' => is_string($targetLanguage) ? $targetLanguage : '',
            'source' => is_string($sourceLanguage) ? $sourceLanguage : '',
            'format' => is_string($format) ? $format : '',
        ];
    }
}
