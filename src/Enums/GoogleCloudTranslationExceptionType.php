<?php

namespace NaimKhalifa\GoogleCloudTranslation\Enums;

enum GoogleCloudTranslationExceptionType
{
    case MissingApiKey;
    case MissingDefaultSourceLanguage;
    case MissingDefaultTargetLanguage;
    case MissingInput;
    case InvalidDefaultSourceLanguage;
    case SameSourceAndTargetLanguages;
    case TranslationFailed;
}
