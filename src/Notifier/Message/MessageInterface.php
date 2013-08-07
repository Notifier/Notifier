<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Message;

use Notifier\Recipient\RecipientInterface;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
interface MessageInterface
{
    public function getType();

    /**
     * @return RecipientInterface[]
     */
    public function &getRecipients();

    /**
     * @return string
     */
    public function getSubject();

    /**
     * @return string
     */
    public function getContent();

    /**
     * @return bool
     */
    public function sendBulk();
}
