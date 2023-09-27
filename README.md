# A package to easily integrate Google Cloud Translation API with Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/naimkhalifa/laravel-google-cloud-translation.svg?style=flat-square)](https://packagist.org/packages/naimkhalifa/laravel-google-cloud-translation)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/naimkhalifa/laravel-google-cloud-translation/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/naimkhalifa/laravel-google-cloud-translation/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/naimkhalifa/laravel-google-cloud-translation/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/naimkhalifa/laravel-google-cloud-translation/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/naimkhalifa/laravel-google-cloud-translation.svg?style=flat-square)](https://packagist.org/packages/naimkhalifa/laravel-google-cloud-translation)



## Installation

You can install the package via composer:

```bash
composer require naimkhalifa/laravel-google-cloud-translation
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-google-cloud-translation-config"
```

This is the contents of the published config file:

```php

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
```

## Usage


#### GoogleCloudTranslation::translate(string \$text, array $options)

Use this method if you want to translate a single text string.

```php
# This would translate using default_source_language 
# and default_target_language config values
GoogleCloudTranslation::translate('Hello World');

# with options
GoogleCloudTranslation::translate('Hello World', [
  'source' => 'en',
  'target' => 'fr',
  'format' => 'text', # or 'html'
]);
```

#### GoogleCloudTranslation::translateBatch(array \$input, array $options)

Use this method if you want to translate multiple strings at once.

```php

GoogleCloudTranslation::translateBatch([
  'Something else',
  'Another string to translate',
  'And a third one because we can'
])

# You can also pass options to this method
GoogleCloudTranslation::translateBatch('Hello World', [
  'source' => 'en',
  'target' => 'fr',
  'format' => 'text', # or 'html'
]);
```


## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Naïm Khalifa](https://github.com/naimkhalifa)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
