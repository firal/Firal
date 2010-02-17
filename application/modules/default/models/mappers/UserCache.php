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
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/**
 * User model mapper cache
 *
 * @category   Firal
 * @package    Default_Models
 * @subpackage Mapper
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
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
     * The cache instance
     *
     * @var Zend_Cache_Core
     */
    protected $_cache;


    /**
     * Constructor
     *
     * @param Default_Model_Mapper_UserInterface $mapper
     *
     * @return void
     */
    public function __construct(Default_Model_Mapper_UserInterface $mapper, Zend_Cache_Core $cache)
    {
        $this->_mapper = $mapper;
        $this->_cache  = $cache;
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
        $cache = $this->getCache();
        if (!$user = $cache->load('user_id_' . $id)) {
            $user = $this->_mapper->fetchById($id);

            $cache->save($user, 'user_id_' . $id);
        }
        return $user;
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
        $cache = $this->getCache();
        if (!$user = $cache->load('user_name_' . $name)) {
            $user = $this->_mapper->fetchByName($name);

            $cache->save($user, 'user_name_' . $name);
        }
        return $user;
    }

    /**
     * Check if a user exists by its name
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasUser($name)
    {
        return $this->_mapper->hasUser($name);
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

    /**
     * Insert a new user
     *
     * @param Default_Model_User $user
     *
     * @return void
     */
    public function insert(Default_Model_User $user)
    {
        return $this->_mapper->insert($user);
    }

    /**
     * Update a user
     *
     * @param Default_Model_User $user
     *
     * @return void
     */
    public function update(Default_Model_User $user)
    {
        return $this->_mapper->insert($user);
    }

    /**
     * Get the cache
     *
     * @return Zend_Cache_Core
     */
    public function getCache()
    {
        return $this->_cache;
    }

}
