<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Tests\Stubs;

use Notifier\Channel\ChannelInterface;
use Notifier\Message\MessageInterface;
use Notifier\Recipient\RecipientInterface;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class Channel implements ChannelInterface
{
    /**
     * @var MessageInterface[]
     */
    public $messages = array();

    /**
     * @return string
     */
    public static function getChannelName()
    {
        return 'stubChannel';
    }

    /**
     * @param  MessageInterface   $message
     * @param  RecipientInterface $recipient
     * @return bool
     */
    public function isHandling(MessageInterface $message, RecipientInterface $recipient)
    {
        return true;
    }

    /**
     * @param  MessageInterface   $message
     * @param  RecipientInterface $recipient
     * @return bool
     */
    public function send(MessageInterface $message, RecipientInterface $recipient)
    {
        $this->messages[] = $message;
    }
}
