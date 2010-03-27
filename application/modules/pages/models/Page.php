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
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/**
 * User model
 *
 * @category   Firal
 * @package    Pages_Models
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Pages_Model_Page extends Firal_Model_ModelAbstract
{

    /**
     * Id
     *
     * @var int
     */
    protected $_id;

    /**
     * Author
     *
     * @var Default_Model_User
     */
    protected $_author;

    /**
     * Name
     *
     * @var string
     */
    protected $_name;

    /**
     * Content
     *
     * @var string
     */
    protected $_content;


    /**
     * Constructor
     *
     * @param array $values
     *
     * @return void
     */
    public function __construct(array $values = array())
    {
        if (isset($values['id'])) {
            $this->_id = $values['id'];
        }
        if (isset($values['author'])) {
            $this->_author = $values['author'];
        }
        if (isset($values['name'])) {
            $this->_name = $values['name'];
        }
        if (isset($values['content'])) {
            $this->_password = $values['content'];
        }
    }

    /**
     * Get the id
     *
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Get the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Get the content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * Get the author
     *
     * @return Default_Model_User
     */
    public function getAuthor()
    {
        return $this->_author;
    }
}
