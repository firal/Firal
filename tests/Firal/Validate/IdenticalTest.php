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
 * @package    Firal_Validate
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

require_once dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'TestHelper.php';

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Firal_Validate_IdenticalTest::main');
}

/**
 * @category   Firal
 * @package    Firal_Validate
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Firal_Validate_IdenticalTest extends PHPUnit_Framework_TestCase
{

    protected $_form;
    
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite('Firal_Validate_IdenticalTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function testIdenticalUsesField()
    {
        $validator = new Firal_Validate_Identical();

        $validator->setField('test');

        $this->assertTrue($validator->isValid('foo', array('test' => 'foo')));
        $this->assertFalse($validator->isValid('foo', array('test' => 'bar')));
    }
}

if (PHPUnit_MAIN_METHOD == 'Firal_Validate_IdenticalTest::main') {
    Firal_Validate_IdenticalTest::main();
}
