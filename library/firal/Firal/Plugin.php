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
 * @package    Firal_Plugin
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */


/**
 * A Plugin
 *
 * @category   Firal
 * @package    Firal_Plugin
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
abstract class Firal_Plugin
{

    /**
     * Event dispatcher
     *
     * @var Firal_Event_Dispatcher
     */
    protected $_dispatcher;

    /**
     * Default event dispatcher
     *
     * @var Firal_Event_Dispatcher
     */
    protected static $_defaultDispatcher;


    /**
     * Construct the plugin
     *
     * @param array $options
     *
     * @return void
     */
    public function __construct(array $options = array())
    {
        if (isset($options['dispatcher']) && ($options['dispatcher'] instanceof Firal_Event_Dispatcher)) {
            $this->setDispatcher($options['dispatcher']);
        } else {
            $this->setDispatcher(self::getDefaultDispatcher());
        }
    }

    /**
     * Set the dispatcher
     *
     * @param Firal_Event_Dispatcher $dispatcher
     *
     * @return Firal_Plugin
     */
    public function setDispatcher(Firal_Event_Dispatcher $dispatcher)
    {
        $this->_dispatcher = $dispatcher;

        return $this;
    }

    /**
     * Get the dispatcher
     *
     * @return Firal_Event_Dispatcher
     */
    public function getDispatcher()
    {
        return $this->_dispatcher;
    }

    /**
     * Set the default event dispatcher
     *
     * @param Firal_Event_Dispatcher $dispatcher
     *
     * @return void
     */
    public static function setDefaultDispatcher(Firal_Event_Dispatcher $dispatcher)
    {
        self::$_defaultDispatcher = $dispatcher;
    }

    /**
     * Get the default event dispatcher
     *
     * @return Firal_Event_Dispatcher
     */
    public static function getDefaultDispatcher()
    {
        return self::$_defaultDispatcher;
    }

}