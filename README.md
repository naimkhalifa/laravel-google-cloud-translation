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

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-google-cloud-translation-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-google-cloud-translation-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-google-cloud-translation-views"
```

## Usage

```php
$laravelGoogleCloudTranslation = new NaimKhalifa\LaravelGoogleCloudTranslation();
echo $laravelGoogleCloudTranslation->echoPhrase('Hello, NaimKhalifa!');
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
