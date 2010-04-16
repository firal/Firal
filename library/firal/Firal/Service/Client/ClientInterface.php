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
 * @package    Firal_Service
 * @subpackage Client
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/**
 * Abstract client service
 *
 * @category   Firal
 * @package    Firal_Service
 * @subpackage Client
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
interface Firal_Service_Client_ClientInterface
{

    /**
     * Constructor
     *
     * @param string $url
     *
     * @return void
     */
    public function __construct($url);

    /**
     * Magic call method to call an RPC method
     *
     * @param string $name
     * @param array $arguments
     *
     * @return mixed
     */
    public function __call($name, array $arguments);

    /**
     * Magic get method to get a namespace
     *
     * @param string $name
     *
     * @return Firal_Service_Client_Namespace
     */
    public function __get($name);

    /**
     * Call an RPC method
     *
     * This method's name argument must be a string like:
     *
     * <namespace>.<namespace>.<method>
     *
     * @param string $method
     * @param array $params
     *
     * @return mixed
     */
    public function call($method, $params = array());
}
