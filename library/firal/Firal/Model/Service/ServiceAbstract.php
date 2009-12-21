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
 * @package    Firal_Model
 * @subpackage Service
 * @copyright  Copyright (c) 2009 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/**
 * Abstract model service
 *
 * @category   Firal
 * @package    Firal_Model
 * @subpackage Service
 * @copyright  Copyright (c) 2009 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
abstract class Firal_Model_Service_ServiceAbstract implements Zend_Acl_Resource_Interface
{

    /**
     * ACL
     *
     * @var Zend_Acl
     */
    protected $_acl;

    /**
     * Default ACL
     *
     * @var Zend_Acl
     */
    protected static $_defaultAcl;

    /**
     * Resource ID
     *
     * @var string
     */
    protected $_resource = '';


    /**
     * Get the ACL
     *
     * @throws Firal_Model_Service_Exception when there is no ACL and no default ACL
     *
     * @return Zend_Acl
     */
    public function getAcl()
    {
        if (null === $this->_acl) {
            if (null === ($this->_acl = self::getDefaultAcl())) {
                throw new Firal_Model_Service_RuntimeException("No ACL and no default ACL defined.");
            }
        }

        return $this->_acl;
    }

    /**
     * Set the ACL
     *
     * @param Zend_Acl $acl
     *
     * @return Firal_Model_Service_ServiceAbstract
     */
    public function setAcl(Zend_Acl $acl)
    {
        $this->_acl = $acl;

        return $this;
    }

    // static functions

    /**
     * Set the default ACL
     *
     * @param Zend_Acl $acl
     *
     * @return void
     */
    public static function setDefaultAcl(Zend_Acl $acl)
    {
        self::$_defaultAcl = $acl;
    }

    /**
     * Get the default ACL
     *
     * @return Zend_Acl
     */
    public static function getDefaultAcl()
    {
        return self::$_defaultAcl;
    }

}