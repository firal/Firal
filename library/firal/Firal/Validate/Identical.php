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
 * @package    Firal_Validate
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/**
 * Identical validator with support for other form fields
 *
 * @category   Firal
 * @package    Firal_Validate
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Firal_Validate_Identical extends Zend_Validate_Identical
{

    /**
     * Field to validate
     *
     * @var string
     */
    protected $_field;


    /**
     * Sets validator options
     *
     * @param mixed $token
     * @param string $field
     *
     * @return void
     */
    public function __construct($token = null, $field = null)
    {
        parent::__construct($token);

        if (null !== $field) {
            $this->setField($field);
        }
    }

    /**
     * Set the field to validate
     *
     * @param string $field
     *
     * @return Firal_Validate_Identical
     */
    public function setField($field)
    {
        $this->_field = $field;

        return $this;
    }

    /**
     * Get the field to validate
     *
     * @return string
     */
    public function getField()
    {
        return $this->_field;
    }

    /**
     * Defined by Zend_Validate_Interface
     *
     * Returns true if and only if a token has been set and the provided value
     * matches that token.
     *
     * @param  mixed $value
     * @param  mixed $context
     *
     * @return boolean
     */
    public function isValid($value, $context = null)
    {
        if ((null === $this->_token) && (null !== $this->_field) && isset($context[$this->getField()])) {
            $this->setToken($context[$this->getField()]);
            $this->_tokenString = str_repeat('*', strlen($this->_tokenString));
        }

        return parent::isValid($value, $context);
    }
}