# AirSob
A Laravel 5.3 Notification/PHP Library for Airsob

# To Use

Run `composer require kasoprecede47/air-sob`

#For Laravel Users
Add `AirSob\AirSobServiceProvider::class` to `app.php` 

Add `'airsob' => [
        'service_id' => 'Your Service Id',
        'service_key' => 'Your Key',
        'format' => 'json'
    ]` to `services.php`



 # AirSob notifications channel for Laravel 5.3

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-notification-channels/AirSob.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/AirSob)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-notification-channels/AirSob.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/AirSob)

This package makes it easy to send [AirSob notifications](https://airsob.com/) with  Laravel 5.3.

## Contents

- [Installation](#installation)
    - [Setting up your AirSob account](#setting-up-your-AirSob-account)
- [Usage](#usage)
    - [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)

## Installation

You can install the package via composer:

``` bash
composer require kasoprecede47/air-sob
```

You must install the service provider:

```php
// config/app.php
'providers' => [
    ...
    AirSob\AirSobServiceProvider::class,
],
```

### Setting up your AirSob account

Add your AirSob Account Key, Acess Token, and From Number (optional) to your `config/services.php`:

```php
// config/services.php
...
'airSob' => [
    'service_id' => 'Your Service Id',
    'service_key' => 'Your Key',
    'format' => 'json'
],
...
```

## Usage

Now you can use the channel in your `via()` method inside the notification:

``` php
use NotificationChannels\AirSob\AirSobChannel;
use NotificationChannels\AirSob\AirSobMessage;
use Illuminate\Notifications\Notification;

class ValentineDateApproved extends Notification
{
    public function via($notifiable)
    {
        return [AirSobChannel::class];
    }

    public function toAirsob($notifiable)
    {
        return (new AirSobMessage('Your {$notifiable->service} account was approved!'));
    }
}
```

In order to let your Notification know which phone number you are sending to, add the `routeNotificationForAirSob` method to your Notifiable model e.g your User Model

```php
public function routeNotificationForAirSob()
{
    return $this->phone; // where `phone` is a field in your users table;
}
```

### Available Message methods

#### AirSobMessage

- `setDestination('')`: Accepts a phone to use as the notification sender.
- `setMesssage('')`: Accepts a string value for the notification body.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.


## Security

If you discover any security related issues, please email kasoprecede47@gmail.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Okafor Akachukwu](https://github.com/kasoprecede47)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.