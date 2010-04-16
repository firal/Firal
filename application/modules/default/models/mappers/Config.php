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
 * Config model mapper class
 *
 * @category   Firal
 * @package    Default_Models
 * @subpackage Mapper
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Default_Model_Mapper_Config extends Firal_Model_Mapper_DbAbstract implements Default_Model_Mapper_ConfigInterface
{

    /**
     * Table name
     *
     * @var string
     */
    protected $_name = 'config';


    /**
     * Fetch all the config directives
     *
     * @param int $id
     *
     * @return Default_Model_User
     */
    public function fetchAll()
    {
        $db = $this->getAdapter();

        $sql = $db->select()
                  ->from($this->getTableName());

        $rows = $db->fetchAll($sql, array(), Zend_Db::FETCH_ASSOC);

        $return = array();

        foreach ($rows as $row) {
            $return[] = new Default_Model_Config($row);
        }

        return $return;
    }

    /**
     * Fetch a user by its name
     *
     * @param string $name
     *
     * @return Default_Model_User
     */
    public function fetchByName($name)
    {
        $db = $this->getAdapter();

        $sql = $db->select()
                  ->from($this->getTableName())
                  ->where('name=?', $name);

        $row = $db->fetchRow($sql);

        if (false === $row) {
            return null;
        }

        return new Default_Model_Config($row);
    }

}
