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
 * @package    Default_Models
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/**
 * Config model
 *
 * @category   Firal
 * @package    Default_Models
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Default_Model_Config extends Firal_Model_ModelAbstract
{

    /**
     * Name
     *
     * @var string
     */
    protected $_name;

    /**
     * Value
     *
     * @var string
     */
    protected $_value;


    /**
     * Constructor
     *
     * @param array $values
     *
     * @return void
     */
    public function __construct(array $values = array())
    {
        if (isset($values['name'])) {
            $this->_name = $values['name'];
        }
        if (isset($values['value'])) {
            $this->_value = $values['value'];
        }
    }

    /**
     * Get the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Get the value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * Set the value
     *
     * @param string $value
     *
     * @return Default_Model_Config
     */
    public function setValue($value)
    {
        $this->_value = $value;

        return $this;
    }

}