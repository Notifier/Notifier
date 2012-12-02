<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Notifier\Handler;

use Notifier\Message\MessageInterface;
use Notifier\Recipient\RecipientInterface;

class NullHandler extends AbstractHandler
{
    protected $deliveryType = 'none';

    protected function send(MessageInterface $message, RecipientInterface $recipient)
    {
        return false === $this->bubble;
    }
}
