<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Tests\Recipient;

use Notifier\Recipient\Recipient;

class RecipientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Notifier\Recipient::__construct
     */
    public function testName()
    {
        $name = 'name of the recipient';
        $recipient = new Recipient($name);
        $this->assertEquals($recipient->getData(), $name);
    }

    /**
     * @covers Notifier\Recipient::setInfo
     * @covers Notifier\Recipient::getInfo
     */
    public function testInfo()
    {
        $recipient = new Recipient('dummy');
        $recipient->setInfo('some', 'thing');
        $this->assertEquals($recipient->getInfo('some'), 'thing');
    }
}
