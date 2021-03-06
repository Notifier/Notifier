<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Recipient;

use Notifier\ParameterBag\ParameterBagTrait;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 * @contributor Joeri van Dooren
 */
class Recipient implements RecipientInterface
{
    use ParameterBagTrait;
}
