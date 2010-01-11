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
 * @package    Default_Models
 * @subpackage Mapper
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/**
 * Config cache mapper class
 *
 * @category   Firal
 * @package    Default_Models
 * @subpackage Mapper
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Default_Model_Mapper_ConfigCache implements Default_Model_Mapper_ConfigInterface
{

    /**
     * The decorated mapper
     *
     * @var Default_Model_Mapper_UserInterface
     */
    protected $_mapper;

    /**
     * The cache instance
     *
     * @var Zend_Cache_Core
     */
    protected $_cache;


    /**
     * Constructor
     *
     * @param Default_Model_Mapper_UserInterface $mapper
     *
     * @return void
     */
    public function __construct(Default_Model_Mapper_ConfigInterface $mapper, Zend_Cache_Core $cache)
    {
        $this->_mapper = $mapper;
        $this->_cache  = $cache;
    }


    /**
     * Fetch all the config directives
     *
     * @param int $id
     *
     * @return Default_Model_User
     */
    public function fetchAll()
    {
        $cache = $this->getCache();
        if (!$config = $cache->load('config_all')) {
            $config = $this->_mapper->fetchAll();

            $cache->save($config, 'config_all');
        }
        return $config;
    }

    /**
     * Fetch a user by its name
     *
     * @param string $name
     *
     * @return Default_Model_User
     */
    public function fetchByName($name)
    {
        $cache = $this->getCache();
        if (!$config = $cache->load('user_name_' . $name)) {
            $config = $this->_mapper->fetchByName($name);

            $cache->save($config, 'config_name_' . $name);
        }
        return $config;
    }

    /**
     * Get the cache
     *
     * @return Zend_Cache_Core
     */
    public function getCache()
    {
        return $this->_cache;
    }

}