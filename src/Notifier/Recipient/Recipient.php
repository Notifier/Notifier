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
     * @var mixed
     */
    protected $data;

    /**
     * @var array
     */
    protected $info = array();

    protected $types = array();

    /**
     * @param mixed $data
     */
    public function __construct($data)
    {
        $this->setData($data);
    }

    /**
     * @param  mixed     $data
     * @return Recipient $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Getter for the recipients name.
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
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
     * @param $deliveryType
     * @return bool
     */
    public function isHandling(MessageInterface $message, $deliveryType)
    {
        if (is_string($this->types)) {
            return $this->types == Notifier::TYPE_ALL;
        } elseif (isset($this->types[$deliveryType]) && is_array($this->types[$deliveryType])) {
            return in_array($message->getType(), $this->types[$deliveryType]);
        }

        return false;
    }
}
