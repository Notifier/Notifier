<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Message;

use Notifier\ParameterBag\ParameterBagTrait;
use Notifier\Type\TypeInterface;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 * @contributor Joeri van Dooren
 */
class Message implements MessageInterface
{
    use ParameterBagTrait;

    /**
     * @var TypeInterface
     */
    private $type;

    /**
     * @param TypeInterface $type
     */
    public function __construct(TypeInterface $type)
    {
        $this->setType($type);
    }

    /**
     * Set the message type.
     *
     * @param TypeInterface $type
     */
    public function setType(TypeInterface $type)
    {
        $this->type = $type;
    }

    /**
     * Get the message type.
     *
     * @return TypeInterface
     */
    public function getType()
    {
        return $this->type;
    }
}
