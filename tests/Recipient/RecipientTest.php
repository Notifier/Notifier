<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Tests\Recipient;

use Notifier\Recipient\Recipient;
use Notifier\Tests\Stubs\ParameterBag;
use Notifier\Tests\Stubs\Type;

/**
 * @author Joeri van Dooren
 */
class RecipientTest extends \PHPUnit_Framework_TestCase
{
    public function testGetParameterBagsSuccess()
    {
        $parameterBagTestChannel = new ParameterBag('test_channel');
        $parameterBagExampleChannel = new ParameterBag('example_channel');

        $recipient = new Recipient(new Type());
        $recipient->addParameterBag($parameterBagTestChannel);
        $recipient->addParameterBag($parameterBagExampleChannel);

        $this->assertArrayHasKey($parameterBagTestChannel->getIdentifier(), $recipient->getParameterBags());
        $this->assertArrayHasKey($parameterBagExampleChannel->getIdentifier(), $recipient->getParameterBags());
    }

    public function testHasParameterBagSuccess()
    {
        $parameterBag = new ParameterBag();
        $recipient = new Recipient(new Type());
        $recipient->addParameterBag($parameterBag);

        $this->assertTrue($recipient->hasParameterBag($parameterBag->getIdentifier()));
    }

    public function testHasParameterBagFail()
    {
        $parameterBag = new ParameterBag();
        $recipient = new Recipient(new Type());

        $this->assertFalse($recipient->hasParameterBag($parameterBag->getIdentifier()));
    }

    public function testGetParameterBagSuccess()
    {
        $parameterBag = new ParameterBag();
        $recipient = new Recipient(new Type());
        $recipient->addParameterBag($parameterBag);

        $this->assertInstanceOf(
            'Notifier\\ParameterBag\\ParameterBagInterface',
            $recipient->getParameterBag($parameterBag->getIdentifier())
        );
    }

    public function testGetParameterBagFail()
    {
        $parameterBag = new ParameterBag();
        $recipient = new Recipient(new Type());
        $recipient->addParameterBag($parameterBag);

        $this->assertNull($recipient->getParameterBag('wrong_channel'));
    }
}
