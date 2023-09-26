<?php

namespace NaimKhalifa\LaravelGoogleCloudTranslation\Enums;

enum TranslationFailedExceptionType
{
  case ApiKeyNotSet;
  case TranslationFailed;
}
