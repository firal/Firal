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
 * @package    Pages_Models
 * @subpackage Mapper
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/**
 * User model mapper interface
 *
 * @category   Firal
 * @package    Pages_Models
 * @subpackage Mapper
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
interface Pages_Model_Mapper_PageInterface
{


    /**
     * Fetch a page by its id
     *
     * @param int $id
     *
     * @return Pages_Model_Page
     */
    public function fetchById($id);

    /**
     * Fetch a page by its name
     *
     * @param string $name
     *
     * @return Pages_Model_Page
     */
    public function fetchByName($name);

    /**
     * Insert a new page
     *
     * @param Pages_Model_Page $page
     *
     * @return void
     */
    public function insert(Pages_Model_Page $user);

    /**
     * Update a user
     *
     * @param Pages_Model_Page $page
     *
     * @return void
     */
    public function update(Pages_Model_Page $user);

}
