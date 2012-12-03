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

/**
 * Notifo handler.
 *
 * This handler sends the message to the notifo API.
 * Recipients requires 'notifo.username' and 'notifo.apisecret'.
 */
class NotifoHandler extends AbstractHandler
{
    /**
     * The type of notification this handler sends.
     *
     * @var string
     */
    protected $deliveryType = 'notifo';

    /**
     * The type of notification send to notifo.
     *
     * @var string
     */
    protected $method;

    /**
     * The data set.
     *
     * @var array
     */
    protected $data;

    /*
     * if you are on a shared host or do not have access to install
     * the root CA certificates on your server, set this to true
     * or the curl_exec call may fail with null.
     *
     * @var bool
     */
    protected $sharedHosting = false;

    /**
     * @param array|string $types The types this handler handles.
     * @param bool $bubble Whether the messages that are handled can bubble up the stack or not
     * @param null|array $data The base data.
     * @param string $method Type of notification notifo will send.
     */
    public function __construct($types = Notifier::TYPE_ALL, $data = null, $method = 'send_notification', $bubble = true)
    {
        $this->setTypes($types);
        $this->setData($data);
        $this->method = $method;
        $this->bubble = $bubble;
    }

    /**
     * Construct the base data set.
     *
     * @param array $data
     */
    protected function setData(array $data = null)
    {
        if (is_null($data)) {
            $data = array(
                'label' => 'test',
                'uri' => $_SERVER['HTTP_HOST'],
            );
        }
        $this->data = $data;
    }

    /**
     * Send the message to the recipient. If one of the required items is not
     * set, we won't send it as notifo will return an error.
     *
     * @param \Notifier\Message\MessageInterface $message
     * @param \Notifier\Recipient\RecipientInterface $recipient
     * @return mixed|void
     */
    protected function send(MessageInterface $message, RecipientInterface $recipient)
    {
        if (!strlen($message->getSubject()) || !strlen($message->getContent())) {
            return;
        }
        if (!$recipient->getInfo('notifo.username') || !$recipient->getInfo('notifo.apisecret')) {
            return;
        }

        $data = array_merge($this->data, array(
            'title' => $message->getSubject(),
            'msg' => $message->getContent(),
        ));
        $url = 'https://api.notifo.com/v1/' . $this->method;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        curl_setopt($ch, CURLOPT_USERPWD, $recipient->getInfo('notifo.username') . ':' . $recipient->getInfo('notifo.apisecret'));
        curl_setopt($ch, CURLOPT_HEADER, false);

        if ($this->sharedHosting) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        curl_exec($ch);
    }

}
