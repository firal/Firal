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
 * User client service class
 *
 * @category   Firal
 * @package    Default_Services
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Default_Service_UserClient implements Default_Service_UserInterface
{

    /**
     * RPC client
     *
     * @var Firal_Service_Client_ClientInterface
     */
    protected $_client;

    /**
     * Login form instance
     *
     * @var Default_Form_UserLogin
     */
    protected $_loginForm;

    /**
     * Register form instance
     *
     * @var Default_Form_UserRegister
     */
    protected $_registerForm;


    /**
     * Constructor
     *
     * @param Firal_Service_Client_ClientInterface $client
     *
     * @return void
     */
    public function __construct(Firal_Service_Client_ClientInterface $client)
    {
        $this->_client = $client;
    }

    /**
     * Log the user in
     *
     * @param array $data
     *
     * @return bool
     */
    public function login(array $data)
    {
        $form = $this->getLoginForm();

        if (!$form->isValid($data)) {
            return false;
        }

        return $this->_client->login($form->getValues());
    }

    /**
     * Register a user
     *
     * @param array $data
     *
     * @return bool
     */
    public function register(array $data)
    {
        $form = $this->getRegisterForm();

        if (!$form->isValid($data)) {
            return false;
        }

        return $this->_client->register($form->getValues());
    }

    /**
     * Log the user out
     *
     * @return void
     */
    public function logout()
    {
        Zend_Auth::getInstance()->clearIdentity();
    }

    /**
     * Get the login form
     *
     * @return Default_Form_Login
     */
    public function getLoginForm()
    {
        if (null === $this->_loginForm) {
            $this->_loginForm = new Default_Form_UserLogin();
        }

        return $this->_loginForm;
    }

    /**
     * Get the register form
     *
     * @return Default_Form_UserRegister
     */
    public function getRegisterForm()
    {
        if (null === $this->_registerForm) {
            $this->_registerForm = new Default_Form_UserRegister();
        }

        return $this->_registerForm;
    }
}
