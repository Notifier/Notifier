<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Tests;

use PHPUnit_Framework_TestCase;
use Notifier\Tests\Recipient\RecipientTest;
use Notifier\Message\Message;
use Notifier\Handler\NullHandler;
use Notifier\Notifier;

class NotifierTest extends PHPUnit_Framework_TestCase
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
     * @covers Notifier::pushHandler
     * @covers Notifier::popHandler
     */
    public function testPushHandler()
    {
        $handler = new NullHandler();
        $this->notifier->pushHandler($handler);
        $this->assertEquals($handler, $this->notifier->popHandler());
    }

    /**
     * @covers Notifier::sendMessage
     */
    public function testSendMessageSuccess()
    {
        $handler = new NullHandler();
        $this->notifier->pushHandler($handler);
        $message = new Message('test');
        $this->assertTrue($this->notifier->sendMessage($message));
    }

    /**
     * @covers Notifier::sendMessage
     */
    public function testSendMessageFailure()
    {
        $handler = new NullHandler(null);
        $this->notifier->pushHandler($handler);
        $message = new Message('test');
        $this->assertFalse($this->notifier->sendMessage($message));
    }

}
