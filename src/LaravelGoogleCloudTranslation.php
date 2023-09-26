<?php

namespace NaimKhalifa\LaravelGoogleCloudTranslation;

use Google\Cloud\Translate\V2\TranslateClient;
use NaimKhalifa\LaravelGoogleCloudTranslation\Enums\TranslationFailedExceptionType;
use NaimKhalifa\LaravelGoogleCloudTranslation\Exceptions\TranslationFailedException;

class LaravelGoogleCloudTranslation
{

  protected TranslateClient $translateClient;

  public function __construct(TranslateClient $translateClient)
  {
    $this->setupTranslateClient($translateClient);
  }

  protected function setupTranslateClient(TranslateClient $translateClient): void
  {
    if (is_null(config('google-cloud-translation.api_key'))) {
      throw new TranslationFailedException(TranslationFailedExceptionType::ApiKeyNotSet);
    }

    $this->translateClient = new $translateClient(
      [
        'key' => config('google-cloud-translation.api_key')
      ]
    );
  }

  public function translate(string $text, string $targetLanguage): string | TranslationFailedException
  {
    $translation = $this->translateClient->translate($text, [
      'target' => $targetLanguage
    ]);

    if (!isset($translation['text'])) throw new TranslationFailedException(TranslationFailedExceptionType::TranslationFailed);

    return $translation['text'];
  }
}
