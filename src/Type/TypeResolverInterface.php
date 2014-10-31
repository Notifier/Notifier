<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Type;
use Notifier\Channel\ChannelInterface;
use Notifier\Channel\ChannelStore;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
interface TypeResolverInterface
{
    /**
     * Get all channels for a given type of message.
     *
     * @param  TypeInterface      $type
     * @param  ChannelStore $channelStore
     * @return ChannelInterface[]
     */
    public function getChannels(TypeInterface $type, ChannelStore $channelStore);
}
