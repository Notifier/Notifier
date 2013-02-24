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

use Notifier\Message\MessageInterface;
use Notifier\Recipient\RecipientInterface;
use Notifier\Formatter\SwiftMailerFormatter;

class SwiftMailerHandler extends MailHandler
{
	protected $mailer;
	protected $message;

	/**
	 * @param \Swift_Mailer $mailer The mailer to use
	 * @param callback|\Swift_Message $message An example message for real messages, only the body and title will be replaced
	 * @param array|callback $types Types the handler handles. If empty it will handle all.
	 * @param Boolean $bubble Whether the messages that are handled can bubble up the stack or not
	 */
	public function __construct(\Swift_Mailer $mailer, $message, $types = array(), $bubble = true)
	{
		$this->types = $types;
		$this->mailer  = $mailer;
		if (!$message instanceof \Swift_Message && is_callable($message)) {
			$message = call_user_func($message);
		}
		if (!$message instanceof \Swift_Message) {
			throw new \InvalidArgumentException('You must provide either a Swift_Message instance or a callback returning it');
		}
		$this->message = $message;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function send(MessageInterface $message, RecipientInterface $recipient)
	{
		$mail = clone $this->message;
		$mail->setTo($recipient->getInfo('email'));
		$mail->setSubject($message->getSubject());
		$mail->setBody($message->getContent(), 'text/html');
		$this->mailer->send($mail);
	}

	/**
	 * Gets the formatter.
	 *
	 * @return FormatterInterface
	 */
	function getDefaultFormatter()
	{
		return new SwiftMailerFormatter();
	}
}
