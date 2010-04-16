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
class Default_Service_Config implements Default_Service_ConfigInterface
{

    /**
     * Datamapper used for articles
     *
     * @var Default_Model_Mapper_ConfigInterface
     */
    protected $_mapper;

    /**
     * Zend_Config object
     *
     * @var Zend_Config
     */
    protected $_config;


    /**
     * Constructor
     *
     * @param Default_Model_Mapper_ConfigInterface $mapper
     *
     * @return void
     */
    public function __construct(Default_Model_Mapper_ConfigInterface $mapper)
    {
        $this->_mapper = $mapper;
    }


    /**
     * Get the config object
     *
     * @return Zend_Config
     */
    public function getConfig()
    {
        if (null === $this->_config) {
            $this->_loadConfig();
        }

        return $this->_config;
    }

    /**
     * Load the configuration
     *
     * @return void
     */
    protected function _loadConfig()
    {
        $rowset = $this->_mapper->fetchAll();

        $config = array();

        foreach ($rowset as $row) {
            $config[$row->name] = $row->value;
        }

        $this->_config = new Zend_Config($config);
    }
}
