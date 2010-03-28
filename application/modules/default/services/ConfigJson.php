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
 * Config service JSON decorator
 *
 * @category   Firal
 * @package    Default_Services
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Default_Service_ConfigJson implements Default_Service_ConfigInterface
{

    /**
     * The decorated service
     *
     * @var Default_Service_ConfigInterface
     */
    protected $_service;


    /**
     * Constructor
     *
     * @param Default_Service_ConfigInterface $service
     *
     * @return void
     */
    public function __construct(Default_Service_ConfigInterface $service)
    {
        $this->_service = $service;
    }

    /**
     * Get the configuration
     *
     * An array is returned to maintain a higher level of ompatability with JSON
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->_service->getConfig()->toArray();
    }
}
