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
 * @package    Firal
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/*
 * All Firal code must comply to E_ALL | E_STRICT error level
 */
error_reporting(E_ALL | E_STRICT);

/*
 * Determine the include path
 */
$firalRoot    = realpath(dirname(__FILE__) . '/../');
$library      = $firalRoot . DIRECTORY_SEPARATOR . 'library';
$firalLibrary = $library . DIRECTORY_SEPARATOR . 'firal';
$firalTests   = $firalRoot . DIRECTORY_SEPARATOR . 'tests';
$zfLibrary    = $library . DIRECTORY_SEPARATOR . 'zend';

/*
 * Prepend the Zend Framework library/ and tests/ directories to the
 * include_path. This allows the tests to run out of the box and helps prevent
 * loading other copies of the framework code and tests that would supersede
 * this copy.
 */
$path = array(
    $firalLibrary,
    $firalTests,
    $zfLibrary,
    get_include_path()
);
set_include_path(implode(PATH_SEPARATOR, $path));

/*
 * Initialize the autoloader
 */
require_once 'Zend/Loader/Autoloader.php';
$autoloader = Zend_Loader_Autoloader::getInstance();

$autoloader->registerNamespace('PHPUnit_');

/*
 * Load the user-defined test configuration file, if it exists; otherwise, load
 * the default configuration.
 */
if (is_readable($firalTests . DIRECTORY_SEPARATOR . 'TestConfiguration.php')) {
    require_once $firalTests . DIRECTORY_SEPARATOR . 'TestConfiguration.php';
} else {
    require_once $firalTests . DIRECTORY_SEPARATOR . 'TestConfiguration.php.dist';
}

if (defined('TESTS_GENERATE_REPORT') && TESTS_GENERATE_REPORT === true &&
    version_compare(PHPUnit_Runner_Version::id(), '3.1.6', '>=')) {

    /*
     * Add Firal library/ directory to the PHPUnit code coverage
     * whitelist. This has the effect that only production code source files
     * appear in the code coverage report and that all production code source
     * files, even those that are not covered by a test yet, are processed.
     */
    PHPUnit_Util_Filter::addDirectoryToWhitelist($firalLibrary);

    /*
     * Omit from code coverage reports the contents of the tests directory
     */
    foreach (array('.php', '.phtml', '.csv', '.inc') as $suffix) {
        PHPUnit_Util_Filter::addDirectoryToFilter($firalTests, $suffix);
    }
    PHPUnit_Util_Filter::addDirectoryToFilter(PEAR_INSTALL_DIR);
    PHPUnit_Util_Filter::addDirectoryToFilter(PHP_LIBDIR);
}


/*
 * Unset global variables that are no longer needed.
 */
unset($firalRoot, $firalLibrary, $firalTests, $path);