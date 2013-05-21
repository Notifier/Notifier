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

use Notifier\Formatter\FormatterInterface;
use Notifier\Handler\NullHandler;

class HandlerTest extends \PHPUnit_Framework_TestCase
{
    public function testFormatter()
    {
        $handler = new NullHandler();
        $this->assertTrue($handler->getFormatter() instanceof FormatterInterface);
    }
}
