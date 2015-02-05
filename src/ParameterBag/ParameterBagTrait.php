<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\ParameterBag;

/**
 * @author Joeri van Dooren
 */
trait ParameterBagTrait
{
    /**
     * @var ParameterBagInterface[]
     */
    private $parameterBags = array();

    /**
     * Get all the attached ParameterBags.
     *
     * @return ParameterBagInterface[]
     */
    public function getParameterBags()
    {
        return $this->parameterBags;
    }

    /**
     * Get a specific ParameterBag based on identifier.
     *
     * @param string $identifier
     * @return ParameterBagInterface
     */
    public function getParameterBag($identifier)
    {
        if (isset($this->parameterBags[$identifier])) {
            return $this->parameterBags[$identifier];
        }

        return null;
    }

    /**
     * Check if this message has a specific ParameterBag.
     *
     * @param string $identifier
     * @return bool
     */
    public function hasParameterBag($identifier)
    {
        return isset($this->parameterBags[$identifier]);
    }

    /**
     * Add a ParameterBag.
     *
     * @param ParameterBagInterface $bag
     */
    public function addParameterBag(ParameterBagInterface $bag)
    {
        $this->parameterBags[$bag->getIdentifier()] = $bag;
    }
}
