<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Channel;

use Notifier\Message\MessageInterface;
use Notifier\Recipient\RecipientInterface;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
interface ChannelInterface
{
    /**
     * @param  MessageInterface $message
     * @return bool
     */
    public function isHandling(MessageInterface $message);

    /**
     * @param  MessageInterface   $message
     * @param  RecipientInterface $recipient
     * @return bool
     */
    public function send(MessageInterface $message, RecipientInterface $recipient);
}
