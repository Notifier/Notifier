<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Response;

use Notifier\Exception\HandlerException;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
interface ResponseInterface
{
    /**
     * @return bool
     */
    public function hasErrors();

    /**
     * @return bool
     */
    public function hasWarnings();

    /**
     * @return HandlerException[]
     */
    public function getErrors();

    /**
     * @return HandlerException[]
     */
    public function getWarnings();

    /**
     * @param HandlerException $warning
     */
    public function addWarning(HandlerException $warning);

    /**
     * @return int
     */
    public function getSuccessCount();

    /**
     * @return int
     */
    public function getFailureCount();

    public function addSuccess($count = 1);
}
