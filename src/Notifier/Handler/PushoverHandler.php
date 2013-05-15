<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Joost Faassen <j.faassen@linkorb.com>
 *
 */

namespace Notifier\Handler;

use Notifier\Notifier;
use Notifier\Message\MessageInterface;
use Notifier\Recipient\RecipientInterface;
use LinkORB\Pushover;

class PushoverHandler extends AbstractHandler
{
    protected $deliveryType = 'pushover';
    protected $token;
    protected $userkey;

    /**
     * @param String $token The API token from pushover.net
     * @param string|array $types types
     * @param boolean $bubble Bubble or not.
     */
    public function __construct($token, $types = Notifier::TYPE_ALL, $bubble = true)
    {
        $this->token = $token;
        parent::__construct($types, $bubble);
    }

    protected function send(MessageInterface $message, RecipientInterface $recipient)
    {
        $pushovermessage = new \LinkORB\Pushover\Message(
            $this->token, 
            $recipient->getInfo('pushover.user_key')
        );
        $pushovermessage->setMessage($message->getSubject(), $message->getContent());
        $pushovermessage->setPriority(0, 60, 120);
        $pushovermessage->send();
    }
    
}
