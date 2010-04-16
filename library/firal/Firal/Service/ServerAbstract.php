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
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/**
 * Abstract server service
 *
 * @category   Firal
 * @package    Firal_Service
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
abstract class Firal_Service_ServerAbstract
{

    /**
     * The server object
     *
     * @var Firal_Service_Server_ServerInterface
     */
    protected $_server;


    /**
     * Constructor
     *
     * @param Firal_Service_Server_ServerInterface $server
     *
     * @return void
     */
    public function __construct(Firal_Service_Server_ServerInterface $server)
    {
        $this->_server = $server;
    }

    /**
     * Get the server object
     *
     * @return Firal_Service_Server_ServerInterface
     */
    public function getServer()
    {
        return $this->_server;
    }
}
