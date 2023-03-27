# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/hmimeee/easysendsms.svg?style=flat-square)](https://packagist.org/packages/hmimeee/easysendsms)
[![Total Downloads](https://img.shields.io/packagist/dt/hmimeee/easysendsms.svg?style=flat-square)](https://packagist.org/packages/hmimeee/easysendsms)
![GitHub Actions](https://github.com/hmimeee/easysendsms/actions/workflows/main.yml/badge.svg)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require hmimeee/easysendsms
```

## Usage

Add this method inside the notifiable model to route the attribute for mobile number
```php
/**
* Route notifications for the SMS channel.
*/
public function routeNotificationForSms(Notification $notification): string
{
  return $this->cell_phone_no;
}
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email hmimeee@gmail.com instead of using the issue tracker.

## Credits

-   [Hossain Mohammad Imran](https://github.com/hmimeee)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
