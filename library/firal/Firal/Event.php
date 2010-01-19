<?php
/**
 * Firal
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://firal.org/licenses/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to firal-dev@googlegroups.com so we can send you a copy immediately.
 *
 * @category   Firal
 * @package    Firal_Event
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */


/**
 * An event
 *
 * @category   Firal
 * @package    Firal_Event
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Firal_Event implements ArrayAccess
{

    /**
     * The event's name
     *
     * @var string
     */
    protected $_name;

    /**
     * The event's subject
     *
     * @var mixed
     */
    protected $_subject;

    /**
     * Event parameters
     *
     * @var array
     */
    protected $_parameters = array();


    /**
     * Constructor
     *
     * @param mixed $subject
     * @param string $name
     * @param array $parameters
     *
     * @return void
     */
    public function __construct($subject, $name, array $parameters = array())
    {
        $this->_subject    = $subject;
        $this->_name       = $name;
        $this->_parameters = $parameters;
    }

    /**
     * Get the event's subject
     *
     * @return mixed
     */
    public function getSubject()
    {
        return $this->_subject;
    }

    /**
     * Get the event's name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Check if the offset exists
     *
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->_parameters[$offset]);
    }

    /**
     * Get a parameter
     *
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->_parameters[$offset];
    }

    /**
     * Set a parameter
     *
     * @param mixed $offset
     * @param mixed $value
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->_parameters[$offset] = $value;
    }

    /**
     * Unset a parameter
     *
     * @param mixed $offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->_parameters[$offset]);
    }

}