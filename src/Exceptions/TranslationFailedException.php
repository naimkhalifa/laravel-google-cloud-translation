<?php

namespace NaimKhalifa\GoogleCloudTranslation\Exceptions;

use Exception;
use NaimKhalifa\GoogleCloudTranslation\Enums\TranslationFailedExceptionType;

class TranslationFailedException extends Exception
{
    public function __construct(TranslationFailedExceptionType $type)
    {
        $message = match ($type) {
            TranslationFailedExceptionType::ApiKeyNotSet => 'API key not set',
            TranslationFailedExceptionType::TranslationFailed => 'Translation failed',
        };

        parent::__construct($message);
    }
}
