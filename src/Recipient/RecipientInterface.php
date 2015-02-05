<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Recipient;

use Notifier\ParameterBag\ParameterBagInterface;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 * @contributor Joeri van Dooren
 */
interface RecipientInterface
{
    /**
     * Get all the attached ParameterBags.
     *
     * @return ParameterBagInterface[]
     */
    public function getParameterBags();

    /**
     * Get a specific ParameterBag based on identifier.
     *
     * @param string $identifier
     * @return ParameterBagInterface
     */
    public function getParameterBag($identifier);

    /**
     * Check if this recipient has a specific ParameterBag.
     *
     * @param string $identifier
     * @return bool
     */
    public function hasParameterBag($identifier);

    /**
     * Add a ParameterBag.
     *
     * @param ParameterBagInterface $bag
     */
    public function addParameterBag(ParameterBagInterface $bag);
}
