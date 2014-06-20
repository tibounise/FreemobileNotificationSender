FreemobileNotificationSender (FNS)
==================================

FreemobileNotificationSender (FNS, for short) is a simple PHP class to allow people to send SMS notifications using Free's APIs.

## Setup

Firstly, you will need to setup your Free Mobile account to enable the SMS API. You will also find on Free Mobile's website the credentials you need to use the API.

## Test the API

Copy the `config.example.php` file in order to edit it :

```shell
cp config.example.php config.php
```

Then edit config.php to match your API's credentials. Once everything is set, run `testapi.php`. You should receive a 160-characters SMS.

## Integrating FNS in your own applications

If you are using Packagist to maintain your project's dependencies, you can use it to embed an updated version of FNS. Simply add this in your _composer.json_ file :

```json
{
  "require":{
    "tibounise/freemobilenotificationsender":"1.*"
  }
}
```

If you're using Laravel, you may consider using [aeyoll's](https://github.com/aeyoll) FNS wrapper, available [here](https://github.com/aeyoll/laravel-free-mobile-notification-sender).

## Donate

If this project helped you a lot, please consider donating : [PayPal](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=K65LZXQXASC8E) or [Bitcoin](https://blockchain.info/address/13XFkvDBm8iqbwVC1egYZ8sCSu72eebJ7N).
