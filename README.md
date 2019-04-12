# Bothound

Detect crawlers by User Agent, Referer or IP.

## Installation

You can install the package via composer:

```bash
composer require devworkout/bothound
php artisan migrate
```

## Usage

``` php

        // Check User Agent, Referer, IP
        if ( $networkName = app( 'bothound' )->identifyBot( $userAgent, $referer, $ip ) )
        {
            dd($networkName);
        }
        
        app('bothound')->rememberBot('1.2.3.4','facebook');

```

In Console Kernel:
```php

$schedule->command( 'bothound:optimize' )->daily();

```


### Testing

``` bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email us instead of using the issue tracker.

## Credits

- [devworkout](https://github.com/devworkout)
- [All Contributors](../../contributors)

## Support us

Give us a star!

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
