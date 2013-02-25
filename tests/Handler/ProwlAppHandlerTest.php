<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Notifier\Tests\Handler;

use Notifier\Handler\ProwlAppHandler;
use Notifier\Message\Message;
use Notifier\Notifier;
use Notifier\Recipient\Recipient;


class ProwlAppHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function testFormatter()
    {
        $notifier = new Notifier();
        $notifier->pushProcessor(function($message) {
            $recipients = $message->getRecipients();
            // only set the filters just before sending.
            foreach ($recipients as &$recipient) {
                if ($recipient->getData() == 'Dries') {
                    $recipient->addType('test', 'prowl_app');
                    $recipient->setInfo('prowl_app.api_key', '2ec5996b831a40a4dd300572da547510355e7a54');
                }
            }
            return $message;
        });
        $notifier->pushHandler(new ProwlAppHandler(Notifier::TYPE_ALL, 'App Name'));

        $message = new Message('test');
        $message->setSubject('subject');
        $message->setContent('content');
        $message->addRecipient(new Recipient('Dries'));
        $notifier->sendMessage($message);
    }
}
