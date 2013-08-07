<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Formatter;

use Notifier\Message\MessageInterface;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
interface FormatterInterface
{
    /**
     * @param MessageInterface $message
     * @return MessageInterface
     */
    public function format(MessageInterface $message);
}
