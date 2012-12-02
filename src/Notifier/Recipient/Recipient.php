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

use Notifier\Notifier;
use Notifier\Message\MessageInterface;

class Recipient implements RecipientInterface
{
    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var array
     */
    protected $info = array();

    protected $types = array();

    /**
     * @param string $name
     */
    public function __construct($name = '')
    {
        $this->setName($name);
    }

    /**
     * @param string $name
     * @return Recipient $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Getter for the recipients name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $key
     * @param $value
     */
    public function setInfo($key, $value)
    {
        $this->info[$key] = $value;
    }

    /**
     * @param $key
     * @return bool
     */
    public function getInfo($key)
    {
        if (isset($this->info[$key])) {
            return $this->info[$key];
        }
        return false;
    }

    public function setTypes($types)
    {
        if (is_string($types) && $types != Notifier::TYPE_ALL) {
            $types = array($types);
        }
        $this->types = $types;
    }

    public function addType($type, $deliveryType)
    {
        $this->types[$deliveryType][] = $type;
    }

    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Check if the recipient wants the message.
     *
     * @param MessageInterface $message
     * @return bool
     */
    public function isHandling(MessageInterface $message, $deliveryType)
    {
        if (is_string($this->types)) {
            return $this->types == Notifier::TYPE_ALL;
        }

        if (isset($this->types[$deliveryType]) && is_array($this->types[$deliveryType])) {
            return in_array($message->getType(), $this->types[$deliveryType]);
        }
        elseif (is_string($this->types)) {
            return $this->types == Notifier::TYPE_ALL;
        }

        return false;
    }
}
