#!/usr/bin/php
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
 * @package    Firal_Bootstrap
 * @copyright  Copyright (c) 2009 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

if (!isset($_SERVER['SHELL'])) {
    throw new Exception('I will only operate on a shell!');
}

if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', realpath(dirname(__FILE__) . '/../'));
}

// Define path to application directory
if (!defined('APPLICATION_PATH')) {
    define('APPLICATION_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'application');
}

if (!defined('MODELS_PATH')) {
    define('MODELS_PATH', APPLICATION_PATH . DIRECTORY_SEPARATOR . 'models');
}

// normally, this file is only runned from the development env, so leave that as default
if (!defined('APPLICATION_ENV')) {
    define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));
}

// create our own include path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(ROOT_PATH . '/library/zend'),
    realpath(ROOT_PATH . '/library/firal'),
    '.'
    // get_include_path(), // only add this when there are things not working
)));


/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/config.php'
);

$application->bootstrap();

$db = $application->getBootstrap()->getResource('db');
/* @var $db Zend_Db_Adapter_Abstract */

if (!($db instanceof Zend_Db_Adapter_Pdo_Mysql)) {
    throw new Exception('Currently, this script only supports the PDO_MYSQL adapter.');
}

// emulate prepared statements, because we can't use that with DDL statements
$pdo = $db->getConnection();
/* @var $pdo PDO */

$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);

// get the revisions from the database directory

$directory = new DirectoryIterator(ROOT_PATH . '/data/db');
$revs      = array();
$matches   = array();

foreach ($directory as $file) {
    /* @var $file DirectoryIterator */
    if ($file->isFile() && preg_match('/^([0-9]+)\.sql$/', $file->getFilename(), $matches)) {
        // could be interesting
        $revs[] = (int) $matches[1];
    }
}

sort($revs, SORT_NUMERIC);

// get the current revision

$stmt = $db->query("SHOW TABLES LIKE 'x_current_revision'");

if (count($stmt->fetchAll()) == 0) {
    // no such table, create it
    $sql = <<<DLLSTMT
CREATE TABLE x_current_revision (
    revision INT
) COMMENT = 'Revision table for "syncdb.php", DO NOT TOUCH'
DLLSTMT;
    $db->query($sql);

    $db->insert('x_current_revision', array(
        'revision' => 0
    ));
    $revision = 0;
} else {
    $sql      = "SELECT revision FROM x_current_revision LIMIT 1";
    $revision = (int) $db->query($sql)->fetchColumn(0);
}

// loop through the revisions and execute the queries
try {
    foreach ($revs as $rev) {
        if ($rev > $revision) {
            $queries = file_get_contents(ROOT_PATH . '/data/db/' . $rev . '.sql');
            $queries = explode(';', $queries);

            foreach ($queries as $sql) {
                $sql = trim($sql);
                // we don't execute queries with just whitespace
                if (!empty($sql)) {
                    $db->query($sql);
                }
            }
        }
    }
} catch (Zend_Db_Statement_Exception $e) {
    echo 'Incorrect query! In revision: ' . $rev . "\n";
    echo "Error: \n\n";

    echo $e->getMessage();

    $db->update('x_current_revision', array(
        'revision' => $rev - 1
    ));
    exit("\n");
}

$db->update('x_current_revision', array(
    'revision' => end($revs)
));


echo "\n";