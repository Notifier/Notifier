<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Message;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
interface FormattedMessageInterface
{
    /**
     * @return string
     */
    public function getChannelName();
}
