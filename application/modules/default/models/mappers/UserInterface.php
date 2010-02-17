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
 * User model mapper interface
 *
 * @category   Firal
 * @package    Default_Models
 * @subpackage Mapper
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
interface Default_Model_Mapper_UserInterface extends Zend_Auth_Adapter_Interface
{


    /**
     * Fetch a user by its id
     *
     * @param int $id
     *
     * @return Default_Model_User
     */
    public function fetchById($id);

    /**
     * Fetch a user by its name
     *
     * @param string $name
     *
     * @return Default_Model_User
     */
    public function fetchByName($name);

    /**
     * Check if a user exists by its name
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasUser($name);

    /**
     * Set user credentials
     *
     * @param string $identity
     * @param string $credentials
     *
     * @return Default_Model_Mapper_User
     */
    public function setCredentials($identity, $credentials);

    /**
     * Insert a new user
     *
     * @param Default_Model_User $user
     *
     * @return void
     */
    public function insert(Default_Model_User $user);

    /**
     * Update a user
     *
     * @param Default_Model_User $user
     *
     * @return void
     */
    public function update(Default_Model_User $user);

}
