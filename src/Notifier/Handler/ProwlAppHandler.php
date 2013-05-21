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
use Notifier\Message\MessageInterface;
use Notifier\Recipient\RecipientInterface;
use Prowl\Connector;
use Prowl\Message;

class ProwlAppHandler extends AbstractHandler
{
    protected $deliveryType = 'prowl_app';

    protected $appName;

    public function __construct($types = Notifier::TYPE_ALL, $appName = 'Notifier', $bubble = true)
    {
        $this->appName = $appName;
        parent::__construct($types, $bubble);
    }

    protected function send(MessageInterface $message, RecipientInterface $recipient)
    {
        $oProwl = new Connector();
        $oMsg = new Message();

        try {
            $oProwl->setIsPostRequest(true);
            $oMsg->setPriority(0);

            $oProwl->setFilterCallback(
                function ($sText) {
                    return $sText;
                }
            );

            $oMsg->addApiKey($recipient->getInfo('prowl_app.api_key'));
            $oMsg->setEvent($message->getSubject());

            $oMsg->setDescription($message->getContent());
            $oMsg->setApplication($this->appName);

            $oResponse = $oProwl->push($oMsg);

            if ($oResponse->isError()) {
                $this->errors[] = $oResponse->getErrorAsString();
            }
        } catch (\InvalidArgumentException $oIAE) {
            $this->errors[] = $oIAE->getMessage();
        } catch (\OutOfRangeException $oOORE) {
            $this->errors[] = $oOORE->getMessage();
        }
    }
}
