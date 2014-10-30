<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Tests;

use Notifier\Channel\ChannelStore;
use Notifier\Notifier;
use Notifier\Processor\ProcessorStore;
use Notifier\Recipient\RecipientBLL;
use Notifier\Tests\Stubs\Channel;
use Notifier\Tests\Stubs\Processor;
use Notifier\Type\TypeBLL;

class NotifierTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyConstructor()
    {
        $notifier = new Notifier(new RecipientBLL(), new TypeBLL());

        $this->assertInstanceOf('\Notifier\Channel\ChannelStore', $notifier->getChannelStore());
        $this->assertInstanceOf('\Notifier\Processor\ProcessorStore', $notifier->getProcessorStore());
    }

    public function testChannelConstructor()
    {
        $channelStore = new ChannelStore();
        $notifier = new Notifier(new RecipientBLL(), new TypeBLL(), $channelStore);

        $this->assertInstanceOf('\Notifier\Channel\ChannelStore', $notifier->getChannelStore());
        $this->assertEquals($channelStore, $notifier->getChannelStore());
    }

    public function testAddChannel()
    {
        $channel = new Channel();
        $notifier = new Notifier(new RecipientBLL(), new TypeBLL());

        $notifier->addChannel($channel);

        $this->assertEquals(array($channel), $notifier->getChannelStore()->getChannels());
    }

    public function testProcessorConstructor()
    {
        $processorStore = new ProcessorStore();
        $notifier = new Notifier(new RecipientBLL(), new TypeBLL(), null, $processorStore);

        $this->assertInstanceOf('\Notifier\Processor\ProcessorStore', $notifier->getProcessorStore());
        $this->assertEquals($processorStore, $notifier->getProcessorStore());
    }

    public function testAddProcessor()
    {
        $processor = new Processor();
        $notifier = new Notifier(new RecipientBLL(), new TypeBLL());

        $notifier->addProcessor($processor);

        $this->assertEquals(array($processor), $notifier->getProcessorStore()->getProcessors());
    }
}
