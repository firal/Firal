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
 * Client namespace wrapper
 *
 * @category   Firal
 * @package    Firal_Service
 * @subpackage Client
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Firal_Service_Client_Namespace
{

    /**
     * The client
     *
     * @var Firal_Service_Client_ClientInterface
     */
    protected $_client;

    /**
     * The namespace
     *
     * @var string
     */
    protected $_namespace;


    /**
     * Constructor
     *
     * @param Firal_Service_Client_ClientInterface $client
     * @param string $namespace
     *
     * @return void
     */
    public function __construct(Firal_Service_Client_ClientInterface $client, $namespace)
    {
        $this->_client    = $client;
        $this->_namespace = $namespace;
    }

    /**
     * Magic call method to call an RPC method
     *
     * @param string $name
     * @param array $arguments
     *
     * @return mixed
     */
    public function __call($name, array $arguments)
    {
        return $this->_client->call($this->_namespace . '.' . $name, $arguments);
    }

    /**
     * Magic get method to get a deeper namespace
     *
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        return new self($this->_client, $this->_namespace . '.' . $name);
    }
}
