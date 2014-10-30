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

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class TypeBLL implements TypeResolverInterface
{
    /**
     * @param  TypeInterface      $type
     * @return ChannelInterface[]
     */
    public function getChannels(TypeInterface $type)
    {
        return array();
    }
}
