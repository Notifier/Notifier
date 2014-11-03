Notifier
========

[![Build Status](https://travis-ci.org/Notifier/Notifier.svg?branch=master)](https://travis-ci.org/Notifier/Notifier)
[![Latest Stable Version](https://poser.pugx.org/notifier/notifier/v/stable.svg)](https://packagist.org/packages/notifier/notifier) [![Total Downloads](https://poser.pugx.org/notifier/notifier/downloads.svg)](https://packagist.org/packages/notifier/notifier) [![Latest Unstable Version](https://poser.pugx.org/notifier/notifier/v/unstable.svg)](https://packagist.org/packages/notifier/notifier)
[![Dependency Status](https://www.versioneye.com/user/projects/5452c08f22b4fb8a71000025/badge.svg)](https://www.versioneye.com/user/projects/5452c08f22b4fb8a71000025)
[![License](https://poser.pugx.org/notifier/notifier/license.svg)](https://packagist.org/packages/notifier/notifier)

Notifier acts as a notification center.

Recipients will only receive the messages they signed up for.

**Caution**: Only use **< 2.0** in production!

## Use Case

Say you want your users to choose how they receive notifications from your application. 
For example on a new private message you have them choose SMS, email or both. Notifier will help you handle these choices.
From within your application you don't need to worry about what delivery type the user chose. 
You just send the message indicating what type the message is and Notifier will resolve the correct channels and send it.

## Usage
```php
<?php

use Notifier\Message\Message;
use Notifier\Notifier;
use Notifier\Recipient\Recipient;

// Your implementation of the ChannelResolverInterface.
// This will help decide 
$channelResolver = new ChannelResolver();
$notifier = new Notifier($channelResolver);

// ...

$message = new Message(new AlertType());
$notifier->sendMessage($message, array(new Recipient()));
```

## Current state

The project is in active development of 2.0.x. Please refer to [1.0.x](https://github.com/Notifier/Notifier/blob/1.0.x/README.md) if you want to use this in production.



## Channels

Notifier is stripped of most channels. You can find a [list of all available channels](http://github.com/Notifier).

## Contributing

> All code contributions - including those of people having commit access - must
> go through a pull request and approved by a core developer before being
> merged. This is to ensure proper review of all the code.
>
> Fork the project, create a feature branch, and send us a pull request.
>
> To ensure a consistent code base, you should make sure the code follows
> the [Coding Standards](http://symfony.com/doc/2.0/contributing/code/standards.html)
> which we borrowed from Symfony.
> Make sure to check out [php-cs-fixer](https://github.com/fabpot/PHP-CS-Fixer) as this will help you a lot.

If you would like to help take a look at the [list of issues](http://github.com/Notifier/Notifier/issues).

## Requirements

PHP 5.3.2 or above

## Author and contributors

Dries De Peuter - <dries@nousefreak.be> - <http://nousefreak.be>

See also the list of [contributors](https://github.com/Notifier/Notifier/contributors) who participated in this project.

## License

Notifier is licensed under the MIT license.
