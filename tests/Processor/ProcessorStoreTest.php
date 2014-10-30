<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Tests\Processor;

use Notifier\Processor\ProcessorStore;
use Notifier\Tests\Stubs\Processor;

class ProcessorStoreTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyConstruct()
    {
        $store = new ProcessorStore();

        $this->assertEquals(array(), $store->getProcessors());
    }

    public function testConstruct()
    {
        $processors = array(new Processor());

        $store = new ProcessorStore($processors);

        $this->assertEquals($processors, $store->getProcessors());
    }

    public function testAdd()
    {
        $store = new ProcessorStore();
        $processor = new Processor();

        $store->addProcessor($processor);

        $this->assertEquals(array($processor), $store->getProcessors());
    }
}
