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
 * @package    Firal_Model
 * @subpackage Mapper
 * @copyright  Copyright (c) 2009 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/**
 * Abstract model mapper
 *
 * @category   Firal
 * @package    Firal_Model
 * @subpackage Mapper
 * @copyright  Copyright (c) 2009 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
abstract class Firal_Model_Mapper_MapperAbstract
{

    /**
     * Database adapter
     *
     * @var Zend_Db_Adapter_Abstract
     */
    protected $_adapter;

    /**
     * Default database adapter
     *
     * @var Zend_Db_Adapter_Abstract
     */
    protected static $_defaultAdapter;


    /**
     * Constructor
     *
     * This method is final, because it should not be used to initialize, use
     * {@link _init()} instead
     *
     * @param Zend_Db_Adapter_Abstract $adapter
     *
     * @throws Firal_Model_Mapper_RuntimeException If there is no adapter defined
     *
     * @return void
     */
    final public function __construct(Zend_Db_Adapter_Abstract $adapter = null)
    {
        if (null === $adapter) {
            $adapter = self::getDefaultAdapter();
        }

        if (null === $adapter) {
            throw new Firal_Model_Mapper_RuntimeException('There was no adapter defined');
        }

        $this->_adapter = $adapter;

        $this->_init();
    }

    /**
     * Init hook
     *
     * @return void
     */
    protected function _init()
    {}

    /**
     * Get the database adapter
     *
     * @return Zend_Db_Adapter_Abstract
     */
    public function getAdapter()
    {
        return $this->_adapter;
    }


    // static functions

    /**
     * Set the default database adapter
     *
     * @param Zend_Db_Adapter_Abstract $adapter
     *
     * @return void
     */
    public static function setDefaultAdapter(Zend_Db_Adapter_Abstract $adapter)
    {
        self::$_defaultAdapter = $adapter;
    }

    /**
     * Get the default database adapter
     *
     * @return Zend_Db_Adapter_Abstract
     */
    public static function getDefaultAdapter()
    {
        return self::$_defaultAdapter;
    }

}