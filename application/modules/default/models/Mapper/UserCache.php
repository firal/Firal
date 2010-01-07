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
 * @subpackage Mapper
 * @copyright  Copyright (c) 2009 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/**
 * User model mapper class
 *
 * @category   Firal
 * @package    Default_Models
 * @subpackage Mapper
 * @copyright  Copyright (c) 2009 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Default_Model_Mapper_UserCache implements Default_Model_Mapper_UserInterface
{

    /**
     * The decorated mapper
     *
     * @var Default_Model_Mapper_UserInterface
     */
    protected $_mapper;


    /**
     * Constructor
     *
     * @param Default_Model_Mapper_UserInterface $mapper
     *
     * @return void
     */
    public function __construct(Default_Model_Mapper_UserInterface $mapper)
    {
        $this->_mapper = $mapper;
    }

    /**
     * Fetch a user by its id
     *
     * @param int $id
     *
     * @return Default_Model_User
     *
     * @todo implement caching
     */
    public function fetchById($id)
    {
        return $this->_mapper->fetchById($id);
    }

    /**
     * Fetch a user by its name
     *
     * @param string $name
     *
     * @return Default_Model_User
     *
     * @todo implement caching
     */
    public function fetchByName($name)
    {
        return $this->_mapper->fetchByName($name);
    }

    /**
     * Set user credentials
     *
     * @param string $identity
     * @param string $credentials
     *
     * @return Default_Model_Mapper_User
     */
    public function setCredentials($identity, $credentials)
    {
        $this->_mapper->setCredentials($identity, $credentials);
    }

    /**
     * Try to authenticate a user
     *
     * @return Zend_Auth_Result
     */
    public function authenticate()
    {
        return $this->_mapper->authenticate();
    }

}