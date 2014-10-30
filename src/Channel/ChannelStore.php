<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Channel;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class ChannelStore
{
    /**
     * @var ChannelInterface[]
     */
    private $channels;

    /**
     * @param array $channels
     */
    public function __construct($channels = array())
    {
        $this->channels = $channels;
    }

    /**
     * @param ChannelInterface $channel
     */
    public function addChannel(ChannelInterface $channel)
    {
        $this->channels[] = $channel;
    }

    /**
     * @return ChannelInterface[]
     */
    public function getChannels()
    {
        return $this->channels;
    }
}
