<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Tests\Channel;

use Notifier\Channel\ChannelStore;
use Notifier\Tests\Stubs\Channel;

class ChannelStoreTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyConstruct()
    {
        $store = new ChannelStore();

        $this->assertEquals(array(), $store->getChannels());
    }

    public function testConstruct()
    {
        $processors = array(new Channel());

        $store = new ChannelStore($processors);

        $this->assertEquals($processors, $store->getChannels());
    }

    public function testAdd()
    {
        $store = new ChannelStore();
        $processor = new Channel();

        $store->addChannel($processor);

        $this->assertEquals(array($processor), $store->getChannels());
    }
}
