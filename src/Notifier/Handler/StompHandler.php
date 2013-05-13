<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Hongliang <h.wang@linkorb.com>
 *
 */

namespace Notifier\Handler;

use Notifier\Message\MessageInterface;
use Notifier\Recipient\RecipientInterface;

class StompHandler extends AbstractHandler
{
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
	 */
	public function __construct($server = 'localhost', $port = 61613, $clientid = 'mystomp', $destination = 'undefined')
    {
        $this->stompserver      = $server;
        $this->stompport        = $port;
        $this->stompclientid    = $clientid;
        $this->stompdestination = $destination;
	}
    
    private function connectSTOMP()
    {
        try {
            $stomp = new Stomp('tcp://' . $this->stompserver . ':' . $this->stompport);
            $stomp->clientId = $this->stompclientid;
            $stomp->connect();
        } catch(StompException $e) {
            throw new \InvalidArgumentException($e->getMessage());
        }
        return $stomp;
	}

    protected function send(MessageInterface $message, RecipientInterface $recipient)
    {
        $stomp	= $this->connectSTOMP();
        $frame	= new Frame('SEND', $this->stompheaders, $message->getContent());
        $res	= $stomp->send('/queue/' . $this->stompdestination, $frame, array(), true);
        //echo "RECEIPT: " . $frame->headers['receipt'];
        return $res;
    }

    public function setStompHeaders($headers = array())
    {
        $this->stompheaders = $headers;
    }

}
