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
 * User server service class
 *
 * @category   Firal
 * @package    Default_Services
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Default_Service_UserServer implements Default_Service_UserInterface
{

    /**
     * Service to decorate toserver
     *
     * @var Default_Service_UserInterface
     */
    protected $_service;


    /**
     * Constructor
     *
     * @param Default_Service_UserInterface $service
     *
     * @return void
     */
    public function __construct(Default_Service_UserInterface $service)
    {
        $this->_service = $service;
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
        return $this->_service->login($data);
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
        return $this->_service->register($data);
    }

    /**
     * Log the user out
     *
     * @return void
     */
    public function logout()
    {
        return $this->_service->logout();
    }

    /**
     * We cannot send a form over RPC
     *
     * @return null
     */
    public function getLoginForm()
    {
        return null;
    }

    /**
     * We cannot send a form over RPC
     *
     * @return null
     */
    public function getRegisterForm()
    {
        return null;
    }
}
