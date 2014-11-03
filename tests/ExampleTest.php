<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Tests;

use Notifier\Message\Message;
use Notifier\Notifier;
use Notifier\Recipient\Recipient;
use Notifier\Tests\Stubs\ChannelResolver;

class ExampleTest extends \PHPUnit_Framework_TestCase
{
    public function testExample()
    {
        $channelResolver = new ChannelResolver();
        $notifier = new Notifier($channelResolver);

        $message = new Message(new Stubs\Type());
        $notifier->sendMessage($message, array(new Recipient()));
    }
}
