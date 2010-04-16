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
 * Config service class
 *
 * @category   Firal
 * @package    Default_Services
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Default_Service_ConfigClient extends Firal_Service_ClientAbstract implements Default_Service_ConfigInterface
{

    /**
     * RPC client
     *
     * @var Firal_Service_Client_ClientInterface
     */
    protected $_client;


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
     * Get the config object
     *
     * @return Zend_Config
     */
    public function getConfig()
    {
        return new Zend_Config($this->_client->getConfig());
    }
}
