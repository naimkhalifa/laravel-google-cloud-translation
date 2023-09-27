<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Google Cloud Translation API Key
    |--------------------------------------------------------------------------
    |
    | Your Google Cloud Translation API Key.
    | You can get it from https://console.cloud.google.com/apis/credentials
    | More info at https://cloud.google.com/translate/docs/setup
    |
    */
    'api_key' => env('GOOGLE_CLOUD_TRANSLATION_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Default Source Language
    |--------------------------------------------------------------------------
    |
    | The default source language to translate from.
    | You can find the list of supported languages here:
    | https://cloud.google.com/translate/docs/languages
    |
    */
    'default_source_language' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Default Target Language
    |--------------------------------------------------------------------------
    |
    | The default target language to translate to.
    | Obviously, it must be different from the default source language.
    |
    */
    'default_target_language' => 'es',

    /*
    |--------------------------------------------------------------------------
    | Default Format
    |--------------------------------------------------------------------------
    |
    | The default format to translate to.
    | Acceptable values are html or text.
    |
    */
    'default_format' => 'text',
];
