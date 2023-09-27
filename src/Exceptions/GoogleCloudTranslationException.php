<?php

namespace NaimKhalifa\GoogleCloudTranslation\Exceptions;

use Exception;
use NaimKhalifa\GoogleCloudTranslation\Enums\GoogleCloudTranslationExceptionType;

class GoogleCloudTranslationException extends Exception
{
    public function __construct(GoogleCloudTranslationExceptionType $type)
    {
        $message = match ($type) {
            GoogleCloudTranslationExceptionType::MissingApiKey => 'Missing API key',
            GoogleCloudTranslationExceptionType::MissingDefaultSourceLanguage => 'Default source language not set',
            GoogleCloudTranslationExceptionType::MissingDefaultTargetLanguage => 'Default target language not set',
            GoogleCloudTranslationExceptionType::MissingInput => 'Missing input',
            GoogleCloudTranslationExceptionType::InvalidDefaultSourceLanguage => 'Invalid default source language',
            GoogleCloudTranslationExceptionType::SameSourceAndTargetLanguages => 'Source and target languages cannot be the same',
            GoogleCloudTranslationExceptionType::TranslationFailed => 'Translation failed',
        };

        parent::__construct($message);
    }
}
