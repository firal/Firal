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
 * @package    Firal_Di
 * @subpackage Container
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */


/**
 * An event
 *
 * @category   Firal
 * @package    Firal_Di
 * @subpackage Container
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
abstract class Firal_Di_Container_ContainerAbstract
{

    /**
     * Container's storage
     *
     * @var array
     */
    protected $_storage;

    /**
     * The container's config
     *
     * @var array
     */
    protected $_config = array();


    /**
     * Constructor
     *
     * @param Zend_Config|array $config
     *
     * @return void
     */
    public function __construct($config = array())
    {
        $this->setConfig($config);
    }

    /**
     * Set the configuration
     *
     * @param Zend_Config|array $config
     *
     * @return Firal_Di_Container_ContainerAbstract
     */
    public function setConfig($config)
    {
        if ($config instanceof Zend_Config) {
            $config = $config->toArray();
        }

        $this->_config = $config;
    }

}