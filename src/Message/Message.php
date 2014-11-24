<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Message;
use Notifier\Type\TypeInterface;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class Message implements MessageInterface
{
    /**
     * @var TypeInterface
     */
    private $type;

    /**
     * @var FormattedMessageInterface[]
     */
    private $formattedMessages;

    /**
     * @param TypeInterface $type
     */
    public function __construct(TypeInterface $type)
    {
        $this->setType($type);
        $this->formattedMessages = array();
    }

    /**
     * @param TypeInterface $type
     */
    public function setType(TypeInterface $type)
    {
        $this->type = $type;
    }

    /**
     * @return TypeInterface
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param FormattedMessageInterface $message
     */
    public function setFormattedMessage(FormattedMessageInterface $message)
    {
        $this->formattedMessages[$message->getChannelName()] = $message;
    }

    /**
     * @param  string                    $channelName
     * @return FormattedMessageInterface
     */
    public function getFormattedMessage($channelName)
    {
        if (isset($this->formattedMessages[$channelName])) {
            return $this->formattedMessages[$channelName];
        }

        return null;
    }
}
