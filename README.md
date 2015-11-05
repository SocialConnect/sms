SocialConnect SMS
=================

## Supported providers

- [x] SMS.RU
- [x] Nexmo
- [x] MessageBird

# How to work

First, you need to setup `ProviderFactory`:

```php
use SocialConnect\Common\Http\Client\Curl;
use SocialConnect\SMS\ProviderFactory;

include_once __DIR__ . '/vendor/autoload.php';

$service = new ProviderFactory(
    array(
        'provider' => array(
            'smsru' => array(
                'appId' => 12345
            )
        )
    ),
    new Curl()
);
```

Next, you need to get provider:

```php
/** @var \SocialConnect\SMS\Provider\SMSRU $provider */
$provider = $service->factory('smsru');
```

You can send `sms`:

```php
$provider->send('+79999999', 'Hello, World!');
```

Or get `balance`:

```php
var_dump($provider->getBalance());
```

# License

This project is open-sourced software licensed under the MIT License.

See the LICENSE file for more information.
