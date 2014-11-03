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
use Notifier\Channel\ChannelResolverInterface;
use Notifier\Channel\ChannelStore;
use Notifier\Recipient\RecipientInterface;
use Notifier\Type\TypeInterface;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class ChannelResolver implements ChannelResolverInterface
{
    /**
     * @param  TypeInterface      $type
     * @param  ChannelStore       $channelStore
     * @return ChannelInterface[]
     */
    public function getChannels(TypeInterface $type, ChannelStore $channelStore)
    {
        return array();
    }

    /**
     * @param  RecipientInterface $recipient
     * @param  TypeInterface      $type
     * @param  ChannelInterface[] $channels
     * @return ChannelInterface[]
     */
    public function filterChannels(RecipientInterface $recipient, TypeInterface $type, array $channels)
    {
        return $channels;
    }
}
