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
use Notifier\Tests\Stubs\ParameterBag;
use Notifier\Tests\Stubs\Type;

/**
 * @author Joeri van Dooren
 */
class MessageTest extends \PHPUnit_Framework_TestCase
{
    public function testGetParameterBagsSuccess()
    {
        $parameterBagTestChannel = new ParameterBag('test_channel');
        $parameterBagExampleChannel = new ParameterBag('example_channel');

        $message = new Message(new Type());
        $message->addParameterBag($parameterBagTestChannel);
        $message->addParameterBag($parameterBagExampleChannel);

        $this->assertArrayHasKey($parameterBagTestChannel->getIdentifier(), $message->getParameterBags());
        $this->assertArrayHasKey($parameterBagExampleChannel->getIdentifier(), $message->getParameterBags());
    }

    public function testHasParameterBagSuccess()
    {
        $parameterBag = new ParameterBag();
        $message = new Message(new Type());
        $message->addParameterBag($parameterBag);

        $this->assertTrue($message->hasParameterBag($parameterBag->getIdentifier()));
    }

    public function testHasParameterBagFail()
    {
        $parameterBag = new ParameterBag();
        $message = new Message(new Type());

        $this->assertFalse($message->hasParameterBag($parameterBag->getIdentifier()));
    }

    public function testGetParameterBagSuccess()
    {
        $parameterBag = new ParameterBag();
        $message = new Message(new Type());
        $message->addParameterBag($parameterBag);

        $this->assertInstanceOf(
            'Notifier\\ParameterBag\\ParameterBagInterface',
            $message->getParameterBag($parameterBag->getIdentifier())
        );
    }

    public function testGetParameterBagFail()
    {
        $parameterBag = new ParameterBag();
        $message = new Message(new Type());
        $message->addParameterBag($parameterBag);

        $this->assertNull($message->getParameterBag('wrong_channel'));
    }
}
