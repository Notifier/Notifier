<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Tests\Stubs;

use Notifier\Message\MessageInterface;
use Notifier\Processor\ProcessorInterface;
use Notifier\Recipient\RecipientInterface;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class Processor implements ProcessorInterface
{
    /**
     * @param  MessageInterface $message
     * @return MessageInterface
     */
    public function preProcessMessage(MessageInterface $message)
    {
        return $message;
    }

    /**
     * @param  MessageInterface   $message
     * @param  RecipientInterface $recipient
     * @return MessageInterface
     */
    public function processMessage(MessageInterface $message, RecipientInterface $recipient)
    {
        return $message;
    }
}
