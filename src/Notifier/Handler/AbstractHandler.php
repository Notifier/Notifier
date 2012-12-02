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
use Notifier\Formatter\FormatterInterface;
use Notifier\Formatter\NullFormatter;
use Notifier\Message\MessageInterface;

abstract class AbstractHandler implements HandlerInterface
{
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
        }
        elseif (is_string($this->types)) {
            return $this->types == Notifier::TYPE_ALL;
        }
        return false;
    }

    public function getDefaultFormatter()
    {
        return new NullFormatter();
    }

    public function getFormatter()
    {
        if (is_null($this->formatter)) {
            $this->formatter = $this->getDefaultFormatter();
        }
        return $this->formatter;
    }

    final public function handle(MessageInterface $message)
    {
        $message = $this->getFormatter()->format($message);
        $this->send($message);
        return false === $this->bubble;
    }

    abstract protected function send(MessageInterface $message);

}
