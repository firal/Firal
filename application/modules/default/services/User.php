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
 * User service class
 *
 * @category   Firal
 * @package    Default_Services
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Default_Service_User implements Default_Service_UserInterface
{

    /**
     * Datamapper used for articles
     *
     * @var Default_Model_Mapper_UserInterface
     */
    protected $_mapper;

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
     * @param Default_Model_Mapper_UserInterface $mapper
     *
     * @return void
     */
    public function __construct(Default_Model_Mapper_UserInterface $mapper)
    {
        $this->_mapper = $mapper;
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

        $this->_mapper->setCredentials($form->getValue('username'), $form->getValue('password'));

        $auth = Zend_Auth::getInstance();

        Firal_Plugin::getDefaultDispatcher()->trigger(new Firal_Event($form, 'default.user.login'));

        $result = $auth->authenticate($this->_mapper);

        // invalid result
        if (!$result->isValid()) {
            switch ($result->getCode()) {
                case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND:
                    $form->getElement('username')->setErrors(array("There is no '{$form->getValue('username')}' user."));
                    break;
                case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:
                    $form->getElement('password')->setErrors(array("Wrong password."));
                    break;
            }
            $auth->getStorage()->write($result->getIdentity());
            return false;
        }

        return true;
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

        // create a user object
        $data = $form->getValues();

        // check if the user exists
        if ($this->_mapper->hasUser($data['username'])) {
            $form->getElement('username')->setErrors(array("User with name '{$form->getValue('username')}' already exists."));
            return false;
        }

        $user = new Default_Model_User();

        $user->setUsername($data['username']);
        $user->setPassword($data['password']);
        $user->setEmail($data['email']);
        $user->setRole('user');

        Firal_Plugin::getDefaultDispatcher()->trigger(new Firal_Event($user, 'default.user.register'));

        // insert the new user
        $this->_mapper->insert($user);

        return true;
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
