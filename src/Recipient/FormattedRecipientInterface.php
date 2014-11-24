<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Recipient;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
interface FormattedRecipientInterface
{
    /**
     * @return string
     */
    public function getChannelName();
}
