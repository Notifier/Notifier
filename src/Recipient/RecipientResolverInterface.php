<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Recipient;
use Notifier\Channel\ChannelInterface;
use Notifier\Type\TypeInterface;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
interface RecipientResolverInterface
{
    /**
     * @param  RecipientInterface $recipient
     * @param  TypeInterface      $type
     * @param  ChannelInterface[] $channels
     * @return ChannelInterface[]
     */
    public function filterChannels(RecipientInterface $recipient, TypeInterface $type, array $channels);
}
