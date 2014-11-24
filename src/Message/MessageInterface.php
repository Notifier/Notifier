<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Message;

use Notifier\Type\TypeInterface;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
interface MessageInterface
{
    /**
     * @param TypeInterface $type
     */
    public function setType(TypeInterface $type);

    /**
     * @return TypeInterface
     */
    public function getType();

    /**
     * @param FormattedMessageInterface $message
     */
    public function setFormattedMessage(FormattedMessageInterface $message);

    /**
     * @param  string                    $channelName
     * @return FormattedMessageInterface
     */
    public function getFormattedMessage($channelName);
}
