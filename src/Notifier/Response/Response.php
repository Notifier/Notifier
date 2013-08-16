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
class Response implements ResponseInterface
{
    /**
     * @var HandlerException[]
     */
    protected $errors = array();

    /**
     * @var HandlerException[]
     */
    protected $warnings = array();

    /**
     * @var int The amount of successfully send messages.
     */
    protected $successCount;

    /**
     * @var int The amount of failed messages.
     */
    protected $failureCount;

    /**
     * @return int
     */
    public function getFailureCount()
    {
        return $this->failureCount;
    }

    /**
     * @return int
     */
    public function getSuccessCount()
    {
        return $this->successCount;
    }

    /**
     * @return HandlerException[]
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return HandlerException[]
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return (bool)count($this->errors);
    }

    /**
     * @return bool
     */
    public function hasWarnings()
    {
        return (bool)count($this->warnings);
    }

    /**
     * Increase the successCount.
     *
     * @param int $count
     * @return int
     */
    public function addSuccess($count = 1)
    {
        return $this->successCount += $count;
    }

    /**
     * Add a warning to the response.
     *
     * @param HandlerException $warning
     */
    public function addWarning(HandlerException $warning)
    {
        $this->warnings[] = $warning;
    }
}
