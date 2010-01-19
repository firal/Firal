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
 * @package    Firal_Event
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */


/**
 * An event
 *
 * @category   Firal
 * @package    Firal_Event
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Firal_Event_Dispatcher
{

    /**
     * Event listeners
     *
     * @var array
     */
    protected $_listeners = array();


    /**
     * Subscribe to an event
     *
     * @param string $name Name of the event
     * @param callback $callback Callback for the event
     *
     * @return void
     */
    public function subscribe($name, $callback)
    {
        if (!is_callable($callback)) {
            throw new Firal_Event_InvalidArgumentException("You need to provide a valid callback.");
        }
        $this->_listeners[$name][] = $callback;
    }

    /**
     * Unsubscribe from an event
     *
     * @param string $name
     * @param callback $callback
     *
     * @return void
     */
    public function unsubscribe($name, $callback)
    {
        if (!empty($this->_listeners[$name])) {
            foreach ($this->_listeners[$name] as $key => $listener) {
                if ($callback == $listener) {
                    unset($this->_listeners[$name][$key]);
                    return;
                }
            }
        }
    }

    /**
     * Trigger an event
     *
     * @param Firal_Event $event
     *
     * @return void
     */
    public function trigger(Firal_Event $event)
    {
        if (!empty($this->_listeners[$event->getName()])) {
            foreach ($this->_listeners[$event->getName()] as $listener) {
                call_user_func($listener, $event);
            }
        }
    }

}