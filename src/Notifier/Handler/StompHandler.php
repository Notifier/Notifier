<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Hongliang <h.wang@linkorb.com>
 *
 */

namespace Notifier\Handler;

use Notifier\Notifier;
use Notifier\Message\MessageInterface;
use Notifier\Recipient\RecipientInterface;
use FuseSource\Stomp\Stomp;
use FuseSource\Stomp\Frame;

class StompHandler extends AbstractHandler
{
    protected $deliveryType = 'stomp';
    protected $stompserver;
    protected $stompport;
    protected $stompclientid;
    protected $stompdestination;
    protected $stompheaders = array();

    /**
     * @param String $server The STOMP server.
     * @param Int $port The port number of the STOMP server.
     * @param String $clientid The client id.
     * @param String $destination The desitnation queue.
     * @param string|array $types types
     * @param boolean $bubble Bubble or not.
     */
    public function __construct($server = 'localhost', $port = 61613, $clientid = 'mystomp', $destination = 'undefined', $types = Notifier::TYPE_ALL, $bubble = true)
    {
        $this->stompserver = $server;
        $this->stompport = $port;
        $this->stompclientid = $clientid;
        $this->stompdestination = $destination;
        parent::__construct($types, $bubble);
    }

    protected function send(MessageInterface $message, RecipientInterface $recipient)
    {
        return $this->sendStomp($message, $recipient);
    }

    private function connectSTOMP()
    {
        try {
            $stomp = new Stomp('tcp://' . $this->stompserver . ':' . $this->stompport);
            $stomp->clientId = $this->stompclientid;
            $stomp->connect();
        } catch (StompException $e) {
            throw new \InvalidArgumentException($e->getMessage());
        }
        return $stomp;
    }

    private function sendStomp(MessageInterface $message, RecipientInterface $recipient)
    {
        $stomp = $this->connectSTOMP();
        $frame = new Frame('SEND', $this->stompheaders, $message->getContent());
        $res = $stomp->send('/queue/' . $this->stompdestination, $frame, array(), true);
        return $res;
    }

    public function setStompHeaders($headers = array())
    {
        $this->stompheaders = $headers;
    }
}
