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
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

require_once dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'TestHelper.php';

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Firal_Event_DispatcherTest::main');
}

/**
 * @category   Firal
 * @package    Firal_Event
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Firal_Event_DispatcherTest extends PHPUnit_Framework_TestCase
{

    protected $_triggered = false;

    protected $_dispatcher;

    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite('Firal_Event_DispatcherTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function callback(Firal_Event $event)
    {
        $this->_triggered = true;
    }

    public function setUp()
    {
        $this->_dispatcher = new Firal_Event_Dispatcher();
        $this->_triggered  = false;
    }

    public function testSubscribeAndTriggerEvent()
    {
        $this->_dispatcher->trigger(new Firal_Event($this, 'event'));

        $this->assertFalse($this->_triggered);

        $this->_dispatcher->subscribe('event', array($this, 'callback'));

        $this->_dispatcher->trigger(new Firal_Event($this, 'event'));

        $this->assertTrue($this->_triggered);
    }

    public function testUnsubscribeEvent()
    {
        $this->_dispatcher->trigger(new Firal_Event($this, 'event'));

        $this->assertFalse($this->_triggered);

        $this->_dispatcher->subscribe('event', array($this, 'callback'));

        $this->_dispatcher->trigger(new Firal_Event($this, 'event'));

        $this->assertTrue($this->_triggered);

        $this->_triggered = false;

        $this->_dispatcher->unsubscribe('event', array($this, 'callback'));
    }
}

if (PHPUnit_MAIN_METHOD == 'Firal_Event_DispatcherTest::main') {
    Firal_Event_DispatcherTest::main();
}
