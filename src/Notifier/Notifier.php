<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier;

use Notifier\Exception\HandlerException;
use Notifier\Handler\HandlerInterface;
use Notifier\Processor\ProcessorInterface;
use Notifier\Message\MessageInterface;
use Notifier\Response\Response;
use Notifier\Response\ResponseInterface;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class Notifier
{
    const TYPE_ALL = 'Notifier.all';

    /**
     * @var HandlerInterface[]
     */
    protected $handlers = array();

    /**
     * @var ProcessorInterface[]
     */
    protected $processors = array();

    /**
     * Pushes a handler on to the stack.
     *
     * @param HandlerInterface $handler
     */
    public function pushHandler(HandlerInterface $handler)
    {
        array_unshift($this->handlers, $handler);
    }

    /**
     * Pops a handler from the stack.
     *
     * @return HandlerInterface
     * @throws \LogicException
     */
    public function popHandler()
    {
        if (!count($this->handlers)) {
            throw new \LogicException('You tried to pop from an empty handler stack.');
        }

        return array_shift($this->handlers);
    }

    /**
     * Pushes a processor on to the stack.
     *
     * @param ProcessorInterface $processor
     */
    public function pushProcessor(ProcessorInterface $processor)
    {
        array_unshift($this->processors, $processor);
    }

    /**
     * Pops a processor from the stack.
     *
     * @return ProcessorInterface
     * @throws \LogicException
     */
    public function popProcessor()
    {
        if (!count($this->processors)) {
            throw new \LogicException('You tried to pop from an empty processor stack.');
        }

        return array_shift($this->processors);
    }

    /**
     * Send the message.
     *
     * @param MessageInterface $message
     *
     * @return ResponseInterface
     */
    public function sendMessage(MessageInterface $message)
    {
        $response = new Response();
        if (0 == count($handlers = $this->findHandlers($message))) {
            $response->addWarning(new HandlerException('No handler found.'));
            return $response;
        }

        $message = $this->processMessage($message);
        foreach ($handlers as $handler) {
            $handler->setResponse($response);
            $this->handleMessage($handler, $message);
        }

        return $response;
    }

    /**
     * @param  MessageInterface   $message
     * @return HandlerInterface[]
     */
    private function findHandlers(MessageInterface $message)
    {
        $handlers = array();

        foreach ($this->handlers as $handler) {
            if ($handler->isHandling($message)) {
                $handlers[] = $handler;
            }
        }

        return $handlers;
    }

    /**
     * @param  MessageInterface $message
     * @return MessageInterface
     */
    private function processMessage(MessageInterface $message)
    {
        foreach ($this->processors as $processor) {
            $message = call_user_func($processor, $message);
        }

        return $message;
    }

    /**
     * @param HandlerInterface $handler
     * @param MessageInterface $message
     */
    private function handleMessage(HandlerInterface $handler, MessageInterface $message)
    {
        $handlerRecipients = array();

        foreach ($message->getRecipients() as $recipient) {
            if ($recipient->isAccepting($message, $handler->getDeliveryType())) {
                $handlerRecipients[] = $recipient;
            }
        }

        $handler->handle($message, $handlerRecipients);
    }
}
