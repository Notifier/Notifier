<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Handler;

use Notifier\Notifier;
use Notifier\Recipient\RecipientInterface;
use Notifier\Message\MessageInterface;

class MailHandler extends AbstractHandler
{
    protected $deliveryType = 'mail';
    /**
     * @var array
     */
    protected $headers;

    /**
     * @param string|array $types The types this handler handles.
     * @param Boolean $bubble Whether the messages that are handled can bubble up the stack or not
     */
    public function __construct($types = Notifier::TYPE_ALL, $headers = array(), $bubble = true)
    {
        $this->setTypes($types);
        $this->headers = $headers;
        $this->bubble = $bubble;
    }

    /**
     * {@inheritdocs}
     */
    protected function send(MessageInterface $message, RecipientInterface $recipient)
    {
        $to = $recipient;
        $headers = implode("\r\n", $this->headers);

        mail($to, $message->getSubject(), $message->getContent(), $headers);
    }

}
