<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Processor;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class ProcessorStore
{
    /**
     * @var ProcessorInterface[]
     */
    private $processors;

    /**
     * @param ProcessorInterface[] $processors
     */
    public function __construct($processors = array())
    {
        $this->processors = $processors;
    }

    /**
     * Add a processor.
     *
     * @api
     *
     * @param ProcessorInterface $processor
     */
    public function addProcessor(ProcessorInterface $processor)
    {
        $this->processors[] = $processor;
    }

    /**
     * Get all processors.
     *
     * @api
     *
     * @return ProcessorInterface[]
     */
    public function getProcessors()
    {
        return $this->processors;
    }
}
