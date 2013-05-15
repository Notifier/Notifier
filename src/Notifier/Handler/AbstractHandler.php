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

use Notifier\Notifier;
use Notifier\Recipient\RecipientInterface;
use Notifier\Formatter\FormatterInterface;
use Notifier\Formatter\NullFormatter;
use Notifier\Message\MessageInterface;

abstract class AbstractHandler implements HandlerInterface
{
    /**
     * The type of notification this handler sends.
     *
     * @var string
     */
    protected $deliveryType;

    /**
     * @var bool
     */
    protected $bubble;

    /**
     * @var array|string
     */
    protected $types;

    /**
     * @var FormatterInterface
     */
    protected $formatter;

    /**
     * @var callable[]
     */
    protected $processors = array();

    /**
     * @var array
     */
    protected $errors = array();

    /**
     * @param string|array $types The types this handler handles.
     * @param Boolean $bubble Whether the messages that are handled can bubble up the stack or not
     */
    public function __construct($types = Notifier::TYPE_ALL, $bubble = true)
    {
        $this->setTypes($types);
        $this->bubble = $bubble;
    }

    public function setTypes($types)
    {
        if (is_string($types) && $types != Notifier::TYPE_ALL) {
            $types = array($types);
        }
        $this->types = $types;
    }

    /**
     * Check if the handler handles the
     *
     * @param MessageInterface $message
     * @return bool
     */
    public function isHandling(MessageInterface $message)
    {
        if (is_array($this->types)) {
            return in_array($message->getType(), $this->types);
        } elseif (is_string($this->types)) {
            return $this->types == Notifier::TYPE_ALL;
        }
        return false;
    }

    /**
     * Create a default formatter.
     *
     * @return \Notifier\Formatter\NullFormatter
     */
    public function getDefaultFormatter()
    {
        return new NullFormatter();
    }

    /**
     * Get the formatter. This will use the default as a fallback.
     *
     * @return \Notifier\Formatter\FormatterInterface|\Notifier\Formatter\NullFormatter
     */
    public function getFormatter()
    {
        if (is_null($this->formatter)) {
            $this->formatter = $this->getDefaultFormatter();
        }
        return $this->formatter;
    }

    /**
     * Handle the message.
     *
     * @param \Notifier\Message\MessageInterface $message
     * @param \Notifier\Recipient\RecipientInterface $recipient
     * @return bool
     */
    final public function handle(MessageInterface $message, RecipientInterface $recipient)
    {
        $message = $this->getFormatter()->format($message);
        $this->send($message, $recipient);
        return false === $this->bubble;
    }

    /**
     * Get the delivery types this handler handles.
     *
     * @return string
     */
    public function getDeliveryType()
    {
        return $this->deliveryType;
    }

    /**
     * Return whether an error occurred.
     *
     * @return bool
     */
    public function isError()
    {
        return count($this->errors) > 0;
    }

    /**
     * Get the list of errors.
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Send to a single recipient.
     *
     * @param \Notifier\Message\MessageInterface $message
     * @param \Notifier\Recipient\RecipientInterface $recipient
     * @return mixed
     */
    abstract protected function send(MessageInterface $message, RecipientInterface $recipient);

}
