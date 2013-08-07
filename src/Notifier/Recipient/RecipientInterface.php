<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Recipient;

use Notifier\Message\MessageInterface;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
interface RecipientInterface
{
    public function getData();

    public function getTypes();

    public function getInfo($key);

    public function setInfo($key, $value);

    public function isAccepting(MessageInterface $message, $deliveryType);
}
