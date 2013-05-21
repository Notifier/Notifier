<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Hongliang <h.wang@linkorb.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Notifier\Tests\Handler;

use Notifier\Handler\StompHandler;
use Notifier\Message\Message;
use Notifier\Notifier;
use Notifier\Recipient\Recipient;

class StompHandlerTest extends \PHPUnit_Framework_TestCase
{
    private $stompserver;
    private $stompport;

    public function setUp()
    {
        if (!getenv('STOMP_SERVER') || !getenv('STOMP_PORT')) {
            $this->markTestSkipped('STOMP server not configured.');
        }
        $this->stompserver = getenv('STOMP_SERVER');
        $this->stompport = getenv('STOMP_PORT');
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
                        $recipient->addType('test', 'stomp');
                    }
                }
                return $message;
            }
        );

        $notifier->pushHandler(new StompHandler($this->stompserver, $this->stompport));

        $message = new Message('test');
        $message->setSubject('subject');
        $message->setContent('content');
        $message->addRecipient(new Recipient('Dries'));
        $this->assertTrue($notifier->sendMessage($message));
    }
}
