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
use LinkORB\Pushover\Message;

class PushoverHandler extends AbstractHandler
{
    protected $deliveryType = 'pushover';
    protected $token;
    protected $userkey;

    /**
     * @param String            $token  The API token from pushover.net
     * @param array|bool|string $types  types
     * @param boolean           $bubble Bubble or not.
     */
    public function __construct($token, $types = Notifier::TYPE_ALL, $bubble = true)
    {
        $this->token = $token;
        parent::__construct($types, $bubble);
    }

    /**
     * @param  MessageInterface   $message
     * @param  RecipientInterface $recipient
     * @return mixed|void
     */
    protected function send(MessageInterface $message, RecipientInterface $recipient)
    {
        $pushoverMessage = new Message(
            $this->token,
            $recipient->getInfo('pushover.user_key')
        );
        $pushoverMessage->setMessage($message->getSubject(), $message->getContent());
        $pushoverMessage->setPriority(0, 60, 120);
        $pushoverMessage->send();
    }

}
