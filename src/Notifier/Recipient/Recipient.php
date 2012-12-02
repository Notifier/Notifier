<?php
/**
 * This file is part of the Notifier package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Notifier\Recipient;

class Recipient implements RecipientInterface
{
    /**
     * @var string
     */
    protected $name = '';

    protected $info = array();

    /**
     * @param string $name
     */
    public function __construct($name = '')
    {
        $this->setName($name);
    }

    /**
     * @param string $name
     * @return Recipient $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Getter for the recipients name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $key
     * @param $value
     */
    public function setInfo($key, $value)
    {
        $this->info[$key] = $value;
    }

    /**
     * @param $key
     * @return bool
     */
    public function getInfo($key)
    {
        if (isset($this->info[$key])) {
            return $this->info[$key];
        }
        return false;
    }
}
