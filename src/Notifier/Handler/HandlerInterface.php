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

use Notifier\Formatter\FormatterInterface;
use Notifier\Message\MessageInterface;
use Notifier\Recipient\RecipientInterface;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
interface HandlerInterface
{
    /**
     * Check if the handler will handle this type of message.
     *
     * @param  MessageInterface $message
     * @return mixed
     */
    public function isHandling(MessageInterface $message);

    /**
     * Trigger the handler to handle the provided message.
     *
     * @param  MessageInterface     $message
     * @param  RecipientInterface[] $recipient
     * @return bool                 True means that this handler handled the record, and that bubbling is not permitted.
     *              False means the record was either not processed or that this handler allows bubbling.
     */
    public function handle(MessageInterface $message, array $recipient);

    /**
     * Get the formatter for the current handler.
     *
     * @return FormatterInterface
     */
    public function getFormatter();

    public function getDeliveryType();
}
