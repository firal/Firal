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
 * @package    Default_Controllers
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/**
 * Index Controller
 *
 * @category   Firal
 * @package    Default_Controllers
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class AuthController extends Zend_Controller_Action
{

    /**
     * Index page
     *
     * @return void
     */
    public function indexAction()
    {
        $userService = Zend_Registry::get('Default_DiContainer')->getUserService();

        $this->view->form = $userService->getLoginForm()->setAction($this->getHelper('url')->direct('login'));
    }

    /**
     * Login page
     *
     * @return void
     */
    public function loginAction()
    {
        $userService = Zend_Registry::get('Default_DiContainer')->getUserService();

        if (!$this->getRequest()->isPost()) {
            return $this->getHelper('redirector')->direct('index');
        }

        if (!$userService->login($this->getRequest()->getPost())) {
            $this->view->form = $userService->getLoginForm();

            return $this->render('index');
        }
    }

    /**
     * Logout page
     *
     * @return void
     */
    public function logoutAction()
    {
        $userService = Zend_Registry::get('Default_DiContainer')->getUserService();

        $userService->logout();
    }

    /**
     * Show the register form
     *
     * @return void
     */
    public function registerAction()
    {
        $userService = Zend_Registry::get('Default_DiContainer')->getUserService();

        if ($this->getRequest()->isPost()) {
            if (!$userService->register($this->getRequest()->getPost())) {
                $this->view->form = $userService->getRegisterForm();
            }
        } else {
            $this->view->form = $userService->getRegisterForm();
        }
    }

}
