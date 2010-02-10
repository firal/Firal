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
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'TestHelper.php';

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Firal_PluginTest::main');
}

/**
 * @category   Firal
 * @package    Firal_Plugin
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Firal_PluginTest extends PHPUnit_Framework_TestCase
{

    protected $_dispatcher;

    public $triggered = false;

    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite('Firal_PluginTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function setUp()
    {
        $this->_dispatcher = new Firal_Event_Dispatcher();

        Firal_Plugin::setDefaultDispatcher($this->_dispatcher);

        $this->triggered = false;
    }

    public function testPlugin()
    {
        $plugin = new Firal_Plugin_MockPlugin();

        $this->assertFalse($this->triggered);

        $this->_dispatcher->trigger(new Firal_Event($this, 'test.plugin'));

        $this->assertTrue($this->triggered);
    }
}

if (PHPUnit_MAIN_METHOD == 'Firal_PluginTest::main') {
    Firal_PluginTest::main();
}
