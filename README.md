# Methods to allow the mapping of cases to snake / camel for input / output

[![Latest Version on Packagist](https://img.shields.io/packagist/v/phpsa/laravel-case-remapping.svg?style=flat-square)](https://packagist.org/packages/phpsa/laravel-case-remapping)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/phpsa/laravel-case-remapping/run-tests?label=tests)](https://github.com/phpsa/laravel-case-remapping/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/phpsa/laravel-case-remapping/Check%20&%20fix%20styling?label=code%20style)](https://github.com/phpsa/laravel-case-remapping/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/phpsa/laravel-case-remapping.svg?style=flat-square)](https://packagist.org/packages/phpsa/laravel-case-remapping)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require phpsa/laravel-case-remapping
```


## Usage - Middlware for incomming requests

Add as a middleware:
`Phpsa\LaravelCaseRemapping\Http\Middleware\SnakeCaseInputs` to your route eg:
```php
Route::post('xxx',[...])->withMiddleware(\Phpsa\LaravelCaseRemapping\Http\Middleware\SnakeCaseInputs::class)
```

in your controllers constructor:
```php
public function __construct()
{
    $this->middleware(\Phpsa\LaravelCaseRemapping\Http\Middleware\SnakeCaseInputs::class);
}
```

Or globally via the `app/Http.Kernal.php` file
```php
protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Phpsa\LaravelCaseRemapping\Http\Middleware\SnakeCaseInputs::class
        ],
    ];
```

## Usage - Response wrapping for your Transformers / Response objects
add the following trait to your resource:
`\Phpsa\LaravelCaseRemapping\Http\Resources\WithAcceptedCase`

then in your `toArray` method change to per example
```
public function toArray($request){
    $data = parent::toArray($request);

    ... // any other modifications

    return $this->toAcceptCase($request, $data);
}
```

based on the header value for `X-Accept-Case-Type` passed to the request it will reaturn one of the following
`camel`, `kebab`, `snake`


## Usage - Collection methods
This packages includes 3 collecion macros:

* **snakeKeys** - will convert all array keys to snake case
* **camelKeys** - will convert all array keys to camel case
* **kebabKeys** - will convert all array keys to kebab case


## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Craig Smith](https://github.com/phpsa)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
