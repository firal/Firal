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
 * @package    Firal_Service
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/**
 * Abstract model service
 *
 * @category   Firal
 * @package    Firal_Service
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
abstract class Firal_Service_ServiceAbstract implements Zend_Acl_Resource_Interface
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
     * The services
     *
     * @var array
     */
    protected static $_services = array();


    /**
     * Get the ACL
     *
     * @throws Firal_Service_Exception when there is no ACL and no default ACL
     *
     * @return Zend_Acl
     */
    public function getAcl()
    {
        if (null === $this->_acl) {
            if (null === ($this->_acl = self::getDefaultAcl())) {
                throw new Firal_Service_RuntimeException("No ACL and no default ACL defined.");
            }

            $this->_setupAcl();
        }

        return $this->_acl;
    }

    /**
     * Set the ACL
     *
     * @param Zend_Acl $acl
     *
     * @return Firal_Service_ServiceAbstract
     */
    public function setAcl(Zend_Acl $acl)
    {
        $this->_acl = $acl;

        return $this;
    }

    /**
     * Get the resource ID
     *
     * @return string
     */
    public function getResourceId()
    {
        return $this->_resource;
    }

    /**
     * Setup the ACL
     *
     * @return void
     */
    protected function _setupAcl()
    {
        if (!$this->_acl->has($this)) {
            $this->_acl->add($this);

            $this->_setupPrivileges();
        }
    }

    /**
     * Setup privileges
     *
     * @return void
     */
    abstract protected function _setupPrivileges();


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


    /**
     * Get an attached service
     *
     * @param string $name
     *
     * @return Firal_Service_ServiceAbstract
     *
     * @throws Firal_Service_OutOfBoundsException When the service doesn't exist
     */
    public static function getService($name)
    {
        if (!isset(self::$_services[$name])) {
            throw new Firal_Service_OutOfBoundsException("Service '$name' doesn't exist.");
        }

        return self::$_services[$name];
    }

    /**
     * Attach a service
     *
     * @param Firal_Service_ServiceAbstract $name
     *
     * @return void
     */
    public static function attachService(Firal_Service_ServiceAbstract $service)
    {
        self::$_services[get_class($service)] = $service;
    }

}