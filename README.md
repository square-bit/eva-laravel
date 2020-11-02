# Laravel Email Validation

[![Latest Stable Version](https://poser.pugx.org/square-bit/laravel-eva/v)](//packagist.org/packages/square-bit/laravel-eva)
[![License](https://poser.pugx.org/square-bit/laravel-eva/license)](//packagist.org/packages/square-bit/laravel-eva)
[![Total Downloads](https://poser.pugx.org/square-bit/laravel-eva/downloads)](//packagist.org/packages/square-bit/laravel-eva)

Laravel package for integration with e-va.io service.
Provides a Rule to automatically validate form emails.

### Install
```bash
composer require square-bit/laravel-eva
```
The package will automatically register its service provider.


To publish the default config at `config/eva.php`:
```php
php artisan vendor:publish --provider="Squarebit\EVA\EVAServiceProvider" --tag="config"
```

Make sure you update the `.env` file with a valid API Key (generate one at e-va.io)

|Variables|Default value|
|---|---|
|EVA_APIKEY|null|
|EVA_SERVICE_UNAVAILABLE|true|
|EVA_UNKOWN|false|
|EVA_INVALID|false|
|EVA_RISKY|false|
|EVA_SAFE|true|


### Usage
You can now use EVA to validate any email provided by your users directly with the Laravel Validator.

Let's say you're already validating an email on its basic properties
```php
    return Validator::make($data, [
        [...]
        'email' => ['required', 'string', 'email', 'max:255'],
        [...]
    ]);
```

To get the email validated simply add the EVAValidated class to the list of rules:
```php
use Squarebit\EVA\Rules\EVAValidated

[...]

    return Validator::make($data, [
        [...]
        'email' => [new EVAValidated, 'required', 'string', 'email', 'max:255', 'unique:users'],
        [...]
    ]);

```

That's it !

## Security

If you discover any security related issues, please email info@square-bit.com instead of using the issue tracker.

## Credits

- [Squarebit][link-author]

## License

MIT. Please see the [license file](license.md) for more information.

[link-author]: https://github.com/square-bit
