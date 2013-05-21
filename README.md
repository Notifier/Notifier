Notifier
========

[![Build Status](https://secure.travis-ci.org/NoUseFreak/Notifier.png)](https://travis-ci.org/NoUseFreak/Notifier)

Notifier acts as a notification center.

Recipients will only receive the messages they signed up for.

## Usage
```php
<?php

$notifier = new Notifier\Notifier();
$notifier->pushProcessor(function($message) {
    $recipients = $message->getRecipients();
    // only set the filters just before sending.
    foreach ($recipients as &$recipient) {
        if ($recipient->getData() == 'Dries') {
            $recipient->addType('test', 'var_dump');
        }
    }
    return $message;
});
$notifier->pushHandler(new Notifier\Handler\VarDumpHandler(array('test', 'mailing')));

$message = new Notifier\Message\Message('test');
$message->addRecipient(new Notifier\Recipient\Recipient('Dries'));

$notifier->sendMessage($message);
```

## Current state

The project is still in development and is not yet suited for production environments.

## Handlers

 - _MailHandler_: Send the message via mail.
 - _SwiftMailerHandler_: Send the message using [Swift Mailer](http://swiftmailer.org/).
 - _ProwlAppHandler_: Send the message to iOS using [Prowl](http://www.prowlapp.com/).
 - _PushoverHandler_: Send the message to iOS/android using [Pushover](http://pushover.net/).
 - _StompHandler_: Send the message using [STOMP](http://stomp.fusesource.org/).
 - _NullHandler_: Ignore the message completely.
 - _VarDumpHandler_: Send the output to the screen. (For debugging)

## License

Notifier is licensed under the MIT license.
