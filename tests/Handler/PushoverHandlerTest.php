<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Joost Faassen <j.faassen@linkorb.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Tests\Handler;

use Notifier\Handler\PushoverHandler;
use Notifier\Message\Message;
use Notifier\Notifier;
use Notifier\Recipient\Recipient;

class PushoverHandlerTest extends \PHPUnit_Framework_TestCase
{
    // Apikey for your app
    private $pushover_apikey;
    // Userkey for recipient
    private $pushover_userkey;

    public function setUp()
    {
        if (!getenv('PUSHOVER_APIKEY') || !getenv('PUSHOVER_USERKEY')) {
            $this->markTestSkipped('No pushover api key found.');
        }
        $this->pushover_apikey = getenv('PUSHOVER_APIKEY');
        $this->pushover_userkey = getenv('PUSHOVER_USERKEY');
    }

    public function testHandler()
    {
        $notifier = new Notifier();
        $notifier->pushProcessor(
            function ($message) {
                $recipients = $message->getRecipients();
                // only set the filters just before sending.
                foreach ($recipients as &$recipient) {
                    if ($recipient->getData() == 'Dries') {
                        $recipient->addType('test', 'pushover');
                        $recipient->setInfo('pushover.user_key', $this->pushover_userkey);
                    }
                }

                return $message;
            }
        );

        $notifier->pushHandler(new PushoverHandler($this->pushover_apikey, Notifier::TYPE_ALL, 'App Name'));

        $message = new Message('test');
        $message->setSubject('subject');
        $message->setContent('content');
        $message->addRecipient(new Recipient('Dries'));
        $this->assertTrue($notifier->sendMessage($message));
    }
}
