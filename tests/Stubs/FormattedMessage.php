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
use Notifier\Message\FormattedMessageInterface;
use Notifier\Message\MessageInterface;
use Notifier\Recipient\RecipientInterface;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class FormattedMessage implements FormattedMessageInterface
{
    private $channelName;

    public function __construct($channelName)
    {
        $this->channelName = $channelName;
    }
    /**
     * @return string
     */
    public function getChannelName()
    {
        return $this->channelName;
    }
}
