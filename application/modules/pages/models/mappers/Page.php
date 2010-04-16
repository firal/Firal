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
 * Page model mapper class
 *
 * @category   Firal
 * @package    Pages_Models
 * @subpackage Mapper
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Pages_Model_Mapper_Page extends Firal_Model_Mapper_DbAbstract implements Pages_Model_Mapper_PageInterface
{

    /**
     * Table name
     *
     * @var string
     */
    protected $_name = 'pages';


    /**
     * Fetch a page by its id
     *
     * @param int $id
     *
     * @return Pages_Model_Page
     */
    public function fetchById($id)
    {
        $db = $this->getReadAdapter();

        $sql = $db->select()
                  ->from($this->getTableName())
                  ->where('id=?', $id);

        $row = $db->fetchRow($sql);

        if (false === $row) {
            return null;
        }

        return new Pages_Model_Page($row);
    }

    /**
     * Fetch a page by its name
     *
     * @param string $name
     *
     * @return Pages_Model_Page
     */
    public function fetchByName($name)
    {
        $db = $this->getReadAdapter();

        $sql = $db->select()
                  ->from($this->getTableName())
                  ->where('name=?', $name);

        $row = $db->fetchRow($sql);

        if (false === $row) {
            return null;
        }

        return new Pages_Model_Page($row);
    }

    /**
     * Insert a new page
     *
     * @param Pages_Model_Page $page
     *
     * @return int
     */
    public function insert(Pages_Model_Page $page)
    {
    }

    /**
     * Update a page
     *
     * @param Pages_Model_Page $page
     *
     * @return void
     */
    public function update(Pages_Model_Page $page)
    {
    }

}
