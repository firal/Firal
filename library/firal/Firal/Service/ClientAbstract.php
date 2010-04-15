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
 * Abstract client service
 *
 * @category   Firal
 * @package    Firal_Service
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
abstract class Firal_Service_ClientAbstract
{

    /**
     * The client namespace
     *
     * @var Firal_Service_Client_Namespace
     */
    protected $_client;


    /**
     * Constructor
     *
     * @param Firal_Service_Client_Namespace $client
     *
     * @return void
     */
    public function __construct(Firal_Service_Client_Namespace $client)
    {
        $this->_client = $client;
    }

    /**
     * Get the client object
     *
     * @return Firal_Service_Client_Namespace
     */
    public function getClient()
    {
        return $this->_client;
    }
}
