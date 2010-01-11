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
     * User service instance
     *
     * @var Default_Service_User
     */
    protected $_userService;


    /**
     * Init function
     *
     * @return void
     */
    public function init()
    {
        $cache = $this->getInvokeArg('bootstrap')->getContainer()->offsetGet('cachemanager')->getCache('database');
        $this->_userService = new Default_Service_User(
            new Default_Model_Mapper_UserCache(new Default_Model_Mapper_User(), $cache)
        );
    }

    /**
     * Index page
     *
     * @return void
     */
    public function indexAction()
    {
        $this->view->form = $this->_userService->getForm('login')->setAction($this->getHelper('url')->direct('login'));
    }

    /**
     * Login page
     *
     * @return void
     */
    public function loginAction()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->getHelper('redirector')->direct('index');
        }

        if (!$this->_userService->login($this->getRequest()->getPost())) {
            $this->view->form = $this->_userService->getForm('login');

            return $this->render('index');
        }
    }

}