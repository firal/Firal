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
 * Config model mapper interface
 *
 * @category   Firal
 * @package    Default_Models
 * @subpackage Mapper
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
interface Default_Model_Mapper_ConfigInterface
{


    /**
     * Fetch all config directives
     *
     * @return array
     */
    public function fetchAll();

    /**
     * Fetch one config directive by its name
     *
     * @param string $name
     *
     * @return Default_Model_Config
     */
    public function fetchByName($name);
}