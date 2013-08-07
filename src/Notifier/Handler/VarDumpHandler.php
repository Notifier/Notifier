<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Handler;

use Notifier\Message\MessageInterface;
use Notifier\Recipient\RecipientInterface;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class VarDumpHandler extends AbstractHandler
{
    protected $deliveryType = 'var_dump';

    protected function sendOne(MessageInterface $message, RecipientInterface $recipient)
    {
        var_dump($message, 1);

        return true;
    }

    protected function sendBulk(MessageInterface $message, array $recipients)
    {
        var_dump($message, count($recipients));
    }
}
