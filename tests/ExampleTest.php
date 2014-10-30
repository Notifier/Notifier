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
use Notifier\Recipient\RecipientBLL;
use Notifier\Type\TypeBLL;

class ExampleTest extends \PHPUnit_Framework_TestCase
{
    public function testExample()
    {
        $recipientBLL = new RecipientBLL();
        $typeBLL = new TypeBLL();
        $notifier = new Notifier($recipientBLL, $typeBLL);

        $message = new Message(new Stubs\Type());
        $notifier->sendMessage($message, array(new Recipient()));
    }
}
