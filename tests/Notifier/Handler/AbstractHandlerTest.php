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

use Notifier\Message\Message;
use Notifier\Notifier;
use Notifier\Response\Response;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
abstract class AbstractHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return HandlerInterface
     */
    abstract protected function getHandler();

    /**
     * Test if the handler implements FormatterInterface.
     */
    public function testInstance()
    {
        $this->assertInstanceOf('Notifier\Formatter\FormatterInterface', $this->getHandler()->getFormatter());
    }

    /**
     * Test if the handler returns a response.
     */
    public function testResponse()
    {
        $handler = $this->getHandler();
        $handler->setResponse(new Response());
        $response = $handler->handle(new Message(Notifier::TYPE_ALL), array());

        $this->assertInstanceOf('Notifier\Response\ResponseInterface', $response);
    }
}
