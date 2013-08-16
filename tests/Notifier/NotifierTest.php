<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier;

use Notifier\Handler\NullHandler;
use Notifier\Handler\VarDumpHandler;
use Notifier\Message\Message;
use Notifier\Recipient\Recipient;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class NotifierTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Notifier
     */
    protected $notifier;

    public function setUp()
    {
        $this->notifier = new Notifier();
    }

    public function tearDown()
    {
        unset($this->notifier);
    }

    /**
     * @covers Notifier\Notifier::pushHandler
     * @covers Notifier\Notifier::popHandler
     */
    public function testPushHandler()
    {
        $handler = new NullHandler();
        $this->notifier->pushHandler($handler);
        $this->assertEquals($handler, $this->notifier->popHandler());
    }

    /**
     * @covers Notifier\Notifier::sendMessage
     * @covers Notifier\Notifier::findHandlers
     */
    public function testSendMessageSuccess()
    {
        $handler = new NullHandler();
        $this->notifier->pushHandler($handler);
        $message = new Message('test');
        $response = $this->notifier->sendMessage($message);

        $this->assertFalse($response->hasErrors());
        $this->assertEquals(0, $response->getSuccessCount());
    }

    /**
     * @covers Notifier\Notifier::sendMessage
     * @covers Notifier\Notifier::findHandlers
     */
    public function testSendMessageFailure()
    {
        $message = new Message('test');
        $response = $this->notifier->sendMessage($message);

        $this->assertFalse($response->hasErrors());
        $this->assertTrue($response->hasWarnings());
        $this->assertEquals(0, $response->getSuccessCount());
    }

    /**
     * @dataProvider filterProvider
     */
    public function testRecipientFilterSuccess($handlerType, $messageType, $recipientDeliveryType, $resultRegex)
    {
        $randString = uniqid('testString_');
        $this->expectOutputRegex(sprintf($resultRegex, $randString));

        $handler = new VarDumpHandler($handlerType);
        $this->notifier->pushHandler($handler);

        $recipient = new Recipient('Me');
        $recipient->addType('test', $recipientDeliveryType);

        $message = new Message($messageType);
        $message->setContent($randString);
        $message->addRecipient($recipient);

        $this->notifier->sendMessage($message);
    }

    /**
     * Provides data for testRecipientFilterSuccess
     */
    public function filterProvider()
    {
        return array(
            array('test', 'test', 'var_dump', '/%s/'),
            array('test', 'test', 'unknown',  '/^$/'),
            array('test', 'mail', 'var_dump', '/^$/'),
            array('test', 'mail', 'unknown',  '/^$/'),
            array(null,   'test', 'var_dump', '/^$/'),
            array(null,   'test', 'unknown',  '/^$/'),
            array(null,   'mail', 'var_dump', '/^$/'),
            array(null,   'mail', 'unknown',  '/^$/'),
        );
    }
}
