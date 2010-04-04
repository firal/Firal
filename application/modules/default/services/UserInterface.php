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
 * @package    Default_Services
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/**
 * Config service interface
 *
 * @category   Firal
 * @package    Default_Services
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
interface Default_Service_UserInterface
{

    /**
     * Log the user in
     *
     * @param array $data
     *
     * @return bool
     */
    public function login(array $data);

    /**
     * Register a user
     *
     * @param array $data
     *
     * @return bool
     */
    public function register(array $data);

    /**
     * Log the user out
     *
     * @return void
     */
    public function logout();

    /**
     * Get the login form
     *
     * @return Default_Form_Login
     */
    public function getLoginForm();

    /**
     * Get the register form
     *
     * @return Default_Form_UserRegister
     */
    public function getRegisterForm();
}
