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
 * @package    Firal_Modules_Default
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

require_once dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'TestHelper.php';

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Modules_Default_AuthControllerTest::main');
}

/**
 * @category   Firal
 * @package    Firal_Modules_Default
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Modules_Default_AuthControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite('Modules_Default_AuthControllerTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function setUp()
    {
        $this->bootstrap = new Zend_Application(
            APPLICATION_ENV,
            APPLICATION_PATH . DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR . 'config.php'
        );
        parent::setUp();

        Modules_AllTests::setUpDb($this->bootstrap->getBootstrap()->getResource('db'));
    }

    public function testLoginAction()
    {
        $this->dispatch('/auth');

        $this->assertModule('default');
        $this->assertController('auth');
        $this->assertAction('index');

        // check the page title
        $this->assertQuery('head title', 'Firal CMS Development version');
    }

    public function testLoginFormFailNonExistingUser()
    {
        $request = $this->getRequest();

        $request->setMethod('POST')
                ->setPost(array(
                    'username' => 'nonexisting',
                    'password' => 'nonexisting'
                ));
        $this->dispatch('/auth/login');

        // failed login, user does not exist
        $this->assertQuery('form dd#username-element ul.errors li', 'There is no \'nonexisting\' user.');
    }

    public function testLoginFormFailWrongCredentials()
    {
        $request = $this->getRequest();

        $request->setMethod('POST')
                ->setPost(array(
                    'username' => 'foobar',
                    'password' => 'nonexisting'
                ));
        $this->dispatch('/auth/login');

        // failed login, wrong passwrd
        $this->assertQuery('form dd#password-element ul.errors li', 'Wrong password.');
    }

    public function testLoginForm()
    {
        // now test working login
        $request = $this->getRequest();

        $request->setMethod('POST')
                ->setPost(array(
                    'username' => 'foobar',
                    'password' => 'foobarbaz'
                ));
        $this->dispatch('/auth/login');

        $identity = Zend_Auth::getInstance()->getIdentity();

        $this->assertEquals('foobar', $identity->username);
        $this->assertEquals(sha1('foobarbaz'), $identity->passwordHash);
    }
}

if (PHPUnit_MAIN_METHOD == 'Modules_Default_AuthControllerTest::main') {
    Modules_Default_AuthControllerTest::main();
}
