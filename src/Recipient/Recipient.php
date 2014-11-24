<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Recipient;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class Recipient implements RecipientInterface
{
    /**
     * @var mixed
     */
    private $identifier;

    /**
     * @var mixed
     */
    private $data;

    /**
     * @var FormattedRecipientInterface[]
     */
    private $formattedRecipient;

    /**
     * @param mixed $identifier
     * @param mixed $data
     */
    public function __construct($identifier, $data = null)
    {
        $this->formattedRecipient = array();

        $this->identifier = $identifier;
        $this->data = $data;
    }

    /**
     * @param FormattedRecipientInterface $formattedRecipient
     */
    public function addFormattedRecipient(FormattedRecipientInterface $formattedRecipient)
    {
        $this->formattedRecipient[$formattedRecipient->getChannelName()] = $formattedRecipient;
    }

    /**
     * @param string $channelName
     *
     * @return FormattedRecipientInterface
     */
    public function getFormattedRecipient($channelName)
    {
        if (isset($this->formattedRecipient[$channelName])) {
            return $this->formattedRecipient[$channelName];
        }

        return null;
    }
}
