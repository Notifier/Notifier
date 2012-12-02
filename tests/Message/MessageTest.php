<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Tests\Message;

use Notifier\Message\Message;
use Notifier\Recipient\Recipient;

class MessageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Message
     */
    protected $message;

    public function setUp()
    {
        $this->message = new Message('type');
    }

    public function tearDown()
    {
        unset($this->message);
    }

    /**
     * @covers Notifier\Message::__construct
     * @covers Notifier\Message::getType
     */
    public function testName()
    {
        $type = 'type';
        $message = new Message($type);
        $this->assertEquals($message->getType(), $type);
    }

    /**
     * @covers Notifier\Message::addRecipient
     * @covers Notifier\Message::getRecipients
     */
    public function testAddRecipient()
    {
        $recipient = new Recipient('name');
        $this->message->addRecipient($recipient);
        $this->assertEquals($this->message->getRecipients(), array($recipient));
    }

    /**
     * @covers Notifier\Message::addRecipient
     * @covers Notifier\Message::getRecipients
     */
    public function testEmptyRecipients()
    {
        $this->assertEquals($this->message->getRecipients(), array());
    }

    /**
     * @covers Notifier\Message::setSubject
     * @covers Notifier\Message::getSubject
     */
    public function testSubject()
    {
        $this->message->setSubject('subject');
        $this->assertEquals($this->message->getSubject(), 'subject');
    }

    /**
     * @covers Notifier\Message::setSubject
     * @covers Notifier\Message::getSubject
     */
    public function testContent()
    {
        $this->message->setContent('content');
        $this->assertEquals($this->message->getContent(), 'content');
    }
}
