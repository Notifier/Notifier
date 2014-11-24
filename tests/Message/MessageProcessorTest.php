<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Tests\Message;

use Notifier\Message\Message;
use Notifier\Message\MessageProcessor;
use Notifier\Processor\ProcessorStore;
use Notifier\Recipient\Recipient;
use Notifier\Tests\Stubs\Type;

class MessageProcessorTest extends \PHPUnit_Framework_TestCase
{
    private function buildMessage()
    {
        return new Message(new Type());
    }

    private function buildRecipient()
    {
        return new Recipient(1);
    }

    private function buildStore($processors)
    {
        return new ProcessorStore($processors);
    }

    public function testPrePocessor()
    {
        $message = $this->buildMessage();

        $processor = $this->getMock('\Notifier\Tests\Stubs\Processor');

        $processor
            ->expects($this->once())
            ->method('preProcessMessage')
            ->with($this->equalTo($message));

        $store = $this->buildStore(array($processor));

        $messageProcessor = new MessageProcessor($store);
        $messageProcessor->preProcessMessage($message);
    }

    public function testProcessMessage()
    {
        $message = $this->buildMessage();
        $recipient = $this->buildRecipient();

        $processor = $this->getMock('\Notifier\Tests\Stubs\Processor');
        $processor
            ->expects($this->once())
            ->method('processMessage')
            ->with($this->equalTo($message), $this->equalTo($recipient));

        $store = $this->buildStore(array($processor));

        $messageProcessor = new MessageProcessor($store);
        $messageProcessor->processMessage($message, $recipient);
    }
}
