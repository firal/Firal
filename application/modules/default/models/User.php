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
 * @copyright  Copyright (c) 2009 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/**
 * Index Controller
 *
 * @category   Firal
 * @package    Default_Models
 * @copyright  Copyright (c) 2009 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Default_Model_User extends Firal_Model_ModelAbstract implements Zend_Acl_Role_Interface
{

    /**
     * Id
     *
     * @var int
     */
    protected $_id;

    /**
     * Name
     *
     * @var string
     */
    protected $_name;

    /**
     * Password
     *
     * @var string
     */
    protected $_password;

    /**
     * Email
     *
     * @var string
     */
    protected $_email;

    /**
     * Role
     *
     * @var string
     */
    protected $_role;


    /**
     * Get the role id
     *
     * @return string
     */
    public function getRoleId()
    {
        return $this->_name;
    }

    /**
     * Get the id
     *
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Get the username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->_name;
    }

    /**
     * Set the password
     *
     * @param string $password
     *
     * @return Default_Model_User
     */
    public function setPassword($password)
    {
        $this->_password = sha1($password);

        return $this;
    }

    /**
     * Get the email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Set the email
     *
     * @param string $email
     *
     * @return Default_Model_User
     */
    public function setEmail($email)
    {
        $this->_email = $email;

        return $this;
    }

    /**
     * Get the role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->_role;
    }

    /**
     * Set the role
     *
     * @param string $role
     *
     * @return Default_Model_User
     */
    public function setRole($role)
    {
        $this->_role = $role;

        return $this;
    }

}